
## About:

The project is supposed to handle a mini parcels creation and delivering process.

## Requirements:

- PHP ^7.4.
- all Laravel 8 required PHP extensions.
- MySQL or MariaDB server.

## Involved Entities:

- Sender (User)
- Biker (User)
- Parcel
- Order
- Order status

## Description and flow:
a logged in [SENDER] can create as many parcels as he needs. he can then see their details (pick and delivery locations and current status) in the parcels index page.

a logged in [BIKER] can serve the current parcels available for reserving. order can be progressed as follows:
- STATUS_RESERVED -> a biker reserved the parcel.
- STATUS_PICKED -> a biker has picked up the parcel.
- STATUS_DELIVERED -> a biker has delivered the parcel.

a biker can cancel an order reservation ( if it's allowed by the app), and can also progress with the order 
delivery in a forced mechanism by the app.
