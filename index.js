const states = ["Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", "Goa", "Gujarat", "Haryana",
    "Himachal Pradesh", "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", 
    "Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"];

const stateDropdown = document.getElementById("state");
const cityDropdown = document.getElementById("city");

const cities = {
    "Maharashtra": ["Mumbai", "Pune", "Nagpur", "Nashik", "Aurangabad"],
    "Karnataka": ["Bengaluru", "Mysuru", "Hubli", "Mangalore", "Belgaum"],
    "Tamil Nadu": ["Chennai", "Coimbatore", "Madurai", "Tiruchirappalli", "Salem"],
};

function populateStates() {
    stateDropdown.innerHTML = "<option selected>Select State</option>";
    states.forEach(state => {
        const option = document.createElement("option");
        option.textContent = state;
        option.selected = (state === selectedState && selectedState !== ''); 
        stateDropdown.appendChild(option);
    });

    loadCity(); 
}


function loadCity() {
    cityDropdown.innerHTML = "<option selected>Select City</option>";

    const selectedState = stateDropdown.value;

    if (selectedState in cities) {
        cities[selectedState].forEach(city => {
            const option = document.createElement("option");
            option.textContent = city;
            option.selected = (city === '<?php echo $selectedCity; ?>' && '<?php echo $selectedCity; ?>' !== ''); 
            cityDropdown.appendChild(option);
        });
    }
}

const search = () => {
    const searchBox = document.getElementById("searchInput").value.toUpperCase();
    const colleges = document.querySelectorAll(".colleges");

    colleges.forEach(college => {
        const collegeName = college.querySelector("h1");

        if (collegeName) {
            const textValue = collegeName.textContent || collegeName.innerHTML;

            if (textValue.toUpperCase().indexOf(searchBox) > -1) {
                college.style.display = "";
            } else {
                college.style.display = "none";
            }
        }
    });
};



window.onload = () => {
    populateStates();
    loadCity();
};