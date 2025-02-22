document.getElementById('flight-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const origin = document.getElementById('origin').value;
    const destination = document.getElementById('destination').value;
    const departureDate = document.getElementById('departure-date').value;
    const returnDate = document.getElementById('return-date').value || 'No return date';

    addToItinerary('Flight', origin, departureDate, returnDate);
    event.target.reset();
});

document.getElementById('hotel-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const location = document.getElementById('hotel-location').value;
    const checkInDate = document.getElementById('check-in-date').value;
    const checkOutDate = document.getElementById('check-out-date').value;

    addToItinerary('Hotel', location, checkInDate, checkOutDate);
    event.target.reset();
});

document.getElementById('car-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const pickupLocation = document.getElementById('pickup-location').value;
    const pickupDate = document.getElementById('pickup-date').value;
    const returnDate = document.getElementById('return-date-car').value;

    addToItinerary('Car Rental - Thanks for booking', pickupLocation, pickupDate, returnDate);
    event.target.reset();
});

function addToItinerary(service, location, startDate, endDate) {
    const itineraryList = document.getElementById('itinerary-list');
    const itineraryItem = document.createElement('p');
    
    // Corrected string interpolation using template literals
    itineraryItem.innerHTML = `<strong>${service}</strong>: ${location} from ${startDate} to ${endDate}`;
    
    itineraryList.appendChild(itineraryItem);
}
