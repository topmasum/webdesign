<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Register as Doctor</h1>
        <button id="registerButton">Register as Doctor</button>
<div id="formContainer" class="hidden">
    <form action="register.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="degree">Degree:</label>
        <input type="text" id="degree" name="degree" required>

        <label for="medical">Medical Where Seated:</label>
        <input type="text" id="medical" name="medical" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
         <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="General Physician">General Physician</option>
                    <option value="Pediatrician">Pediatrician</option>
                    <option value="Cardiologist">Cardiologist</option>
                    <option value="Dermatologist">Dermatologist</option>
                    <option value="Neurologist">Neurologist</option>
                </select>

        <label for="visiting_days">Visiting Days:</label>
        <select id="daySelector">
            <option value="Sat">Saturday</option>
            <option value="Sun">Sunday</option>
            <option value="Mon">Monday</option>
            <option value="Tue">Tuesday</option>
            <option value="Wed">Wednesday</option>
            <option value="Thu">Thursday</option>
            <option value="Fri">Friday</option>
        </select>
        <button type="button" id="addDayButton">Select Day</button>

        <!-- Hidden input to hold selected days -->
        <input type="hidden" id="visiting_days" name="visiting_days">
        <div id="selectedDaysDisplay"></div>

        <label for="visiting_time">Visiting Time:</label>
        <input type="text" id="visiting_time" name="visiting_time" placeholder="e.g., 7:30 PM - 9:30 PM" required>

        <button type="submit">Submit</button>
    </form>
</div>


    </div>

    <script>
    document.getElementById('registerButton').addEventListener('click', () => {
        document.getElementById('formContainer').classList.toggle('hidden');
    });
</script>
<script>
    const selectedDays = new Set(); // Use a Set to avoid duplicate days
    const daySelector = document.getElementById('daySelector');
    const addDayButton = document.getElementById('addDayButton');
    const selectedDaysDisplay = document.getElementById('selectedDaysDisplay');
    const visitingDaysInput = document.getElementById('visiting_days');

    addDayButton.addEventListener('click', () => {
        const selectedDay = daySelector.value;
        if (!selectedDays.has(selectedDay)) {
            selectedDays.add(selectedDay);

            // Update the display
            selectedDaysDisplay.innerHTML = Array.from(selectedDays)
                .map(day => `<span>${day}</span>`)
                .join(', ');

            // Update the hidden input
            visitingDaysInput.value = Array.from(selectedDays).join(',');
        }
    });
</script>


    </script>
</body>
</html>