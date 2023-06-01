# Main Requirement

Robusta studio wants to build a fleet-management system (bus-booking system) Having:
1- Egypt cities as stations [Cairo, Giza, AlFayyum, AlMinya, Asyut...]
2- Predefined trips between 2 stations that cross over in-between stations.
ex: Cairo to Asyut trip that crosses over AlFayyum -firstly- then AlMinya.
3- Bus for each trip, each bus has 12 available seats to be booked by users, each seat has an
unique id.
4- Users can book an available trip seat.
For example we have Cairo-Asyut trip that crosses over AlFayyum -firstly- then AlMinya:
any user can book a seat for any of these criteria
(Cairo to AlFayyum), (Cairo to AlMinya), (Cairo to Asyut),
(AlFayyum to AlMinya), (AlFayyum to Asyut) or
(AlMinya to Asyut)
if there is an available seat, taking into consideration if the bus is full from Cairo to
AlMinya, the user cannot book any seat from AlFayyum but he can book from AlMinya.
