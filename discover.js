document.getElementById('random-btn').addEventListener('click', function() {
    const destinationDetails = document.getElementById('destination-details');
    const randomDestinations = [
      {
        name: 'Paris',
        description: 'A city of romance, Eiffel Tower, and rich culture.'
      },
      {
        name: 'Goa',
        description: 'Famous for its beautiful beaches, vibrant nightlife, and rich Portuguese heritage.'
      },
      {
        name: 'Jaipur',
        description: 'The Pink City, known for its palaces, forts, and rich history.'
      },
      {
        name: 'Dubai',
        description: 'A futuristic city with tall skyscrapers, luxury shopping, and attractions like the Burj Khalifa.'
      }
    ];
  
    // Choose a random destination
    const randomDestination = randomDestinations[Math.floor(Math.random() * randomDestinations.length)];
  
    // Display the destination details
    document.getElementById('destination-name').innerText = randomDestination.name;
    document.getElementById('destination-description').innerText = randomDestination.description;
  
    destinationDetails.classList.remove('hidden');  // Reveal the destination details
  });