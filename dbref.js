const dbRef = firebase.database().ref("your/data/path");

function loadInitialData() {
    return new Promise((resolve, reject) => {
        dbRef.once('value')
            .then((snapshot) => {
                // Process the initial data
                snapshot.forEach((childSnapshot) => {
                    const childData = childSnapshot.val();
                    console.log('Existing child data:', childData);
                });

                // Resolve the promise after processing initial data
                resolve();
            })
            .catch((error) => {
                console.error('Error loading initial data:', error);
                reject(error);
            });
    });
}

// Set up listeners after loading initial data
function setUpListeners() {
    dbRef.on('child_added', (snapshot) => {
        const newChildData = snapshot.val();
        console.log('New child added:', newChildData);
    });

    dbRef.on('child_changed', (snapshot) => {
        const updatedData = snapshot.val();
        console.log('Child updated:', updatedData);
    });

    dbRef.on('child_removed', (snapshot) => {
        const removedData = snapshot.val();
        console.log('Child removed:', removedData);
    });
}

// Call loadInitialData and then set up listeners
loadInitialData()
    .then(() => {
        // This will only execute after the initial data has been loaded
        setUpListeners();

        // Execute other scripts or functions here
        console.log('All initial data loaded, listeners set up.');
    })
    .catch((error) => {
        console.error('Failed to load initial data:', error);
    });
