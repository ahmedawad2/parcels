/*!
 * jQuery ComboTree Plugin
 * Author:  Erhan FIRAT
 * Mail:    erhanfirat@gmail.com
 * Licensed under the MIT license
 * Version: 1.1.1
 * Updated by: Yomi Olatunji
 */


;(function ($, window, document, undefined) {

    // Create the defaults once
    var comboTreePlugin = 'comboTree',
        defaults = {
            source: [],
            isMultiple: false,
            cascadeSelect: false,
            selected: [],
        };

    // The actual plugin constructor
    function ComboTree(element, hidden_element, options) {
        this.elemInput = element;
        this._elemInput = $(element);
        this._elemInputId = $(hidden_element);

        this.options = $.extend({}, defaults, options);

        this._defaults = defaults;
        this._name = comboTreePlugin;

        this.init();
    }

    ComboTree.prototype.init = function () {
        // Setting Doms
        this.comboTreeId = 'comboTree' + Math.floor(Math.random() * 999999);

        this._elemInput.addClass('comboTreeInputBox');

        if (this._elemInput.attr('id') === undefined)
            this._elemInput.attr('id', this.comboTreeId + 'Input');
        this.elemInputId = this._elemInput.attr('id');

        this._elemInput.wrap('<div id="' + this.comboTreeId + 'Wrapper" class="comboTreeWrapper"></div>');
        this._elemInput.wrap('<div id="' + this.comboTreeId + 'InputWrapper" class="comboTreeInputWrapper"></div>');
        this._elemWrapper = $('#' + this.comboTreeId + 'Wrapper');

        this._elemArrowBtn = $('<button id="' + this.comboTreeId + 'ArrowBtn" class="comboTreeArrowBtn" type="button"><span class="comboTreeArrowBtnImg">▼</span></button>');
        this._elemInput.after(this._elemArrowBtn);
        this._elemWrapper.append('<div id="' + this.comboTreeId + 'DropDownContainer" class="comboTreeDropDownContainer"><div class="comboTreeDropDownContent"></div>');

        // DORP DOWN AREA
        this._elemDropDownContainer = $('#' + this.comboTreeId + 'DropDownContainer');
        this._elemDropDownContainer.html(this.createSourceHTML());

        this._elemItems = this._elemDropDownContainer.find('li');
        this._elemItemsName = this._elemDropDownContainer.find('span.comboTreeItemName');

        // VARIABLES
        this._selectedItem = {};
        this._selectedItems = [];

        this.processSelected();

        this.bindings();
    };


    // *********************************
    // SOURCES CODES
    // *********************************

    ComboTree.prototype.removeSourceHTML = function () {
        this._elemDropDownContainer.html('');
    };

    ComboTree.prototype.createSourceHTML = function () {
        var sourceHTML = '';
        if (this.options.isMultiple)
            sourceHTML = this.createFilterHTMLForMultiSelect();
        sourceHTML += this.createSourceSubItemsHTML(this.options.source);
        return sourceHTML;
    };

    ComboTree.prototype.createFilterHTMLForMultiSelect = function () {
        return '';
        //hema return '<input id="' + this.comboTreeId + 'MultiFilter" type="text" class="multiplesFilter" placeholder="Type to filter"/>';
    }

    ComboTree.prototype.createSourceSubItemsHTML = function (subItems, isMain = true) {
        var subItemsHtml = '<UL ' + ((isMain ? '' : 'style="display: none; " ')) + '>';

        for (var i = 0; i < subItems.length; i++) {
            subItemsHtml += this.createSourceItemHTML(subItems[i], isMain);
        }
        subItemsHtml += '</UL>'
        return subItemsHtml;
    }

    ComboTree.prototype.createSourceItemHTML = function (sourceItem, isMain) {
        var itemHtml = "";
        var isThereSubs = 0;
        if (sourceItem.subs) {
            isThereSubs = sourceItem.subs.length;
        }
        itemHtml = '<LI class="ComboTreeItem' + (isThereSubs ? 'Parent' : 'Chlid') + '"> ';
        if (isThereSubs)
            itemHtml += '<span class="comboTreeParentPlus">+</span>';

        if (this.options.isMultiple)
            itemHtml += '<span data-id="' + sourceItem.id + '" class="comboTreeItemName"><input type="checkbox" name="categories[]" value="' + sourceItem.id + '">' + sourceItem.name + '</span>';
        else
            itemHtml += '<span data-id="' + sourceItem.id + '" class="comboTreeItemName">' + sourceItem.name + '</span>';

        if (isThereSubs)
            itemHtml += this.createSourceSubItemsHTML(sourceItem.subs, false);

        itemHtml += '</LI>';
        return itemHtml;
    };


    // BINDINGS
    // *****************************
    ComboTree.prototype.bindings = function () {
        var _this = this;

        this._elemArrowBtn.on('click', function (e) {
            e.stopPropagation();
            _this.toggleDropDown();
        });
        this._elemInput.on('click', function (e) {
            e.stopPropagation();
            if (!_this._elemDropDownContainer.is(':visible'))
                _this.toggleDropDown();
        });
        this._elemItems.on('click', function (e) {
            e.stopPropagation();
            if ($(this).hasClass('ComboTreeItemParent')) {
                _this.toggleSelectionTree(this);
            }
        });
        this._elemItemsName.on('click', function (e) {
            e.stopPropagation();
            if (_this.options.isMultiple)
                _this.multiItemClick(this);
            else
                _this.singleItemClick(this);
        });
        this._elemItemsName.on("mousemove", function (e) {
            e.stopPropagation();
            _this.dropDownMenuHover(this);
        });

        // KEY BINDINGS
        this._elemInput.on('keyup', function (e) {
            e.stopPropagation();

            switch (e.keyCode) {
                case 27:
                    _this.closeDropDownMenu();
                    break;
                case 13:
                case 39:
                case 37:
                case 40:
                case 38:
                    e.preventDefault();
                    break;
                default:
                    if (!_this.options.isMultiple)
                        _this.filterDropDownMenu();
                    break;
            }
        });
        if (_this.options.isMultiple) {
            $("#" + _this.comboTreeId + "MultiFilter").on('keyup', function (e) {
                e.stopPropagation();

                switch (e.keyCode) {
                    case 27:
                        $(this).val('');
                        _this.filterDropDownMenu();
                        break;
                    default:
                        _this.filterDropDownMenu();
                        break;
                }
            });
        }

        this._elemInput.on('keydown', function (e) {
            e.stopPropagation();

            switch (e.keyCode) {
                case 9:
                    _this.closeDropDownMenu();
                    break;
                case 40:
                case 38:
                    e.preventDefault();
                    _this.dropDownInputKeyControl(e.keyCode - 39);
                    break;
                case 37:
                case 39:
                    e.preventDefault();
                    _this.dropDownInputKeyToggleTreeControl(e.keyCode - 38);
                    break;
                case 13:
                    if (_this.options.isMultiple)
                        _this.multiItemClick(_this._elemHoveredItem);
                    else
                        _this.singleItemClick(_this._elemHoveredItem);
                    e.preventDefault();
                    break;
                default:
                    if (_this.options.isMultiple)
                        e.preventDefault();
            }
        });
        // ON FOCUS OUT CLOSE DROPDOWN
        $(document).on('mouseup.' + _this.comboTreeId, function (e) {
            if (!_this._elemWrapper.is(e.target) && _this._elemWrapper.has(e.target).length === 0 && _this._elemDropDownContainer.is(':visible'))
                _this.closeDropDownMenu();
        });
    };


    // EVENTS HERE
    // ****************************

    // DropDown Menu Open/Close
    ComboTree.prototype.toggleDropDown = function () {
        this._elemDropDownContainer.slideToggle(50);
        this._elemInput.focus();
    };
    ComboTree.prototype.closeDropDownMenu = function () {
        this._elemDropDownContainer.slideUp(50);
    };
    // Selection Tree Open/Close
    ComboTree.prototype.toggleSelectionTree = function (item, direction) {
        var subMenu = $(item).children('ul')[0];
        if (direction === undefined) {
            if ($(subMenu).is(':visible'))
                $(item).children('span.comboTreeParentPlus').html("+");
            else
                $(item).children('span.comboTreeParentPlus').html("&minus;");

            $(subMenu).slideToggle(50);
        } else if (direction == 1 && !$(subMenu).is(':visible')) {
            $(item).children('span.comboTreeParentPlus').html("&minus;");
            $(subMenu).slideDown(50);
        } else if (direction == -1) {
            if ($(subMenu).is(':visible')) {
                $(item).children('span.comboTreeParentPlus').html("+");
                $(subMenu).slideUp(50);
            } else {
                this.dropDownMenuHoverToParentItem(item);
            }
        }

    };


    // SELECTION FUNCTIONS
    // *****************************
    ComboTree.prototype.selectMultipleItem = function (ctItem) {
        this._selectedItem = {
            id: $(ctItem).attr("data-id"),
            name: $(ctItem).text()
        };

        var index = this.isItemInArray(this._selectedItem, this._selectedItems);
        if (index) {
            this._selectedItems.splice(parseInt(index), 1);
            $(ctItem).find("input").prop('checked', false);
        } else {
            this._selectedItems.push(this._selectedItem);
            $(ctItem).find("input").prop('checked', true);
        }
    }

    ComboTree.prototype.singleItemClick = function (ctItem) {
        this._selectedItem = {
            id: $(ctItem).attr("data-id"),
            name: $(ctItem).text()
        };

        this.refreshInputVal();
        this.closeDropDownMenu();
    };
    ComboTree.prototype.multiItemClick = function (ctItem) {
        this.selectMultipleItem(ctItem);
        if (this.options.cascadeSelect) {
            if ($(ctItem).parent('li').hasClass('ComboTreeItemParent')) {
                var subMenu = $(ctItem).parent('li').children('ul').first().find('input[type="checkbox"]');
                subMenu.each(function () {
                    var $input = $(this)
                    if ($(ctItem).children('input[type="checkbox"]').first().prop("checked") !== $input.prop('checked')) {
                        $input.prop('checked', !$(ctItem).children('input[type="checkbox"]').first().prop("checked"));
                        $input.trigger('click');
                    }
                });
            }
        }
        this.refreshInputVal();
    };


    ComboTree.prototype.isItemInArray = function (item, arr) {
        for (var i = 0; i < arr.length; i++)
            if (item.id == arr[i].id && item.name == arr[i].name)
                return i + "";
        return false;
    }

    ComboTree.prototype.refreshInputVal = function () {
        var tmpName = "";
        var tmpId = "";

        if (this.options.isMultiple) {
            for (var i = 0; i < this._selectedItems.length; i++) {
                tmpName += this._selectedItems[i].name;
                if (i < this._selectedItems.length - 1)
                    tmpName += ", ";
            }
        } else {
            tmpName = this._selectedItem.name;
            tmpId = this._selectedItem.id;
        }

        this._elemInput.val(tmpName);
        this._elemInputId.val(tmpId);
        this._elemInput.trigger('change');
    }

    ComboTree.prototype.dropDownMenuHover = function (itemSpan, withScroll) {
        this._elemItems.find('span.comboTreeItemHover').removeClass('comboTreeItemHover');
        $(itemSpan).addClass('comboTreeItemHover');
        this._elemHoveredItem = $(itemSpan);
        if (withScroll)
            this.dropDownScrollToHoveredItem(this._elemHoveredItem);
    }

    ComboTree.prototype.dropDownScrollToHoveredItem = function (itemSpan) {
        var curScroll = this._elemDropDownContainer.scrollTop();
        this._elemDropDownContainer.scrollTop(curScroll + $(itemSpan).parent().position().top - 80);
    }

    ComboTree.prototype.dropDownMenuHoverToParentItem = function (item) {
        var parentSpanItem = $($(item).parents('li.ComboTreeItemParent')[0]).children("span.comboTreeItemName");
        if (parentSpanItem.length)
            this.dropDownMenuHover(parentSpanItem, true);
        else
            this.dropDownMenuHover(this._elemItemsName[0], true);
    }

    ComboTree.prototype.dropDownInputKeyToggleTreeControl = function (direction) {
        var item = this._elemHoveredItem;
        if ($(item).parent('li').hasClass('ComboTreeItemParent'))
            this.toggleSelectionTree($(item).parent('li'), direction);
        else if (direction == -1)
            this.dropDownMenuHoverToParentItem(item);
    }

    ComboTree.prototype.dropDownInputKeyControl = function (step) {
        if (!this._elemDropDownContainer.is(":visible"))
            this.toggleDropDown();

        var list = this._elemItems.find("span.comboTreeItemName:visible");
        i = this._elemHoveredItem ? list.index(this._elemHoveredItem) + step : 0;
        i = (list.length + i) % list.length;

        this.dropDownMenuHover(list[i], true);
    },

        //hema
        ComboTree.prototype.filterDropDownMenu = function () {
            // var searchText = '';
            // if (!this.options.isMultiple)
            //     searchText = this._elemInput.val();
            // else
            //     searchText = $("#" + this.comboTreeId + "MultiFilter").val();
            //
            // if (searchText != "") {
            //     this._elemItemsName.hide();
            //     this._elemItemsName.siblings("span.comboTreeParentPlus").hide();
            //     list = this._elemItems.find("span:icontains('" + searchText + "')").each(function (i, elem) {
            //         $(this).show();
            //         $(this).siblings("span.comboTreeParentPlus").show();
            //     });
            // } else {
            //     this._elemItemsName.show();
            //     this._elemItemsName.siblings("span.comboTreeParentPlus").show();
            // }
        }

    ComboTree.prototype.processSelected = function () {
        var elements = this._elemItemsName;
        var selectedItem = this._selectedItems;
        var selectedItems = this._selectedItems;
        this.options.selected.forEach(function (element) {
            var selected = $(elements).filter(function () {
                return $(this).data('id') == element;
            });

            if (selected.length > 0) {
                $(selected).find('input').attr('checked', true);

                selectedItem = {
                    id: selected.data("id"),
                    name: selected.text()
                };
                selectedItems.push(selectedItem);
            }
        });

        this.refreshInputVal();
    }

    // Retuns Array (multiple), Integer (single), or False (No choice)
    ComboTree.prototype.getSelectedItemsId = function () {
        if (this.options.isMultiple && this._selectedItems.length > 0) {
            var tmpArr = [];
            for (i = 0; i < this._selectedItems.length; i++)
                tmpArr.push(this._selectedItems[i].id);

            return tmpArr;
        } else if (!this.options.isMultiple && this._selectedItem.hasOwnProperty('id')) {
            return this._selectedItem.id;
        }
        return false;
    }

    // Retuns Array (multiple), Integer (single), or False (No choice)
    ComboTree.prototype.getSelectedItemsName = function () {
        if (this.options.isMultiple && this._selectedItems.length > 0) {
            var tmpArr = [];
            for (i = 0; i < this._selectedItems.length; i++)
                tmpArr.push(this._selectedItems[i].name);

            return tmpArr;
        } else if (!this.options.isMultiple && this._selectedItem.hasOwnProperty('id')) {
            return this._selectedItem.name;
        }
        return false;
    }


    ComboTree.prototype.unbind = function () {
        this._elemArrowBtn.off('click');
        this._elemInput.off('click');
        this._elemItems.off('click');
        this._elemItemsName.off('click');
        this._elemItemsName.off("mousemove");
        this._elemInput.off('keyup');
        this._elemInput.off('keydown');
        this._elemInput.off('mouseup.' + this.comboTreeId);
        $(document).off('mouseup.' + this.comboTreeId);
    }

    ComboTree.prototype.destroy = function () {
        this.unbind();
        this._elemWrapper.before(this._elemInput);
        this._elemWrapper.remove();
        this._elemInput.removeData('plugin_' + comboTreePlugin);
    }


    $.fn[comboTreePlugin] = function (options) {
        var ctArr = [];
        this.each(function () {
            if (!$.data(this, 'plugin_' + comboTreePlugin)) {
                $.data(this, 'plugin_' + comboTreePlugin, new ComboTree(this, $('#category_input_hidden_ids'), options));
                ctArr.push($(this).data()['plugin_' + comboTreePlugin]);
            }
        });

        if (this.length == 1)
            return ctArr[0];
        else
            return ctArr;
    }

})(jQuery, window, document);




