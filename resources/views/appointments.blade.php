<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Couture Shop Appointment</title>
  @vite(['resources/css/styles_appointments.css'])
  <script>
    // Prevent Sunday selection and restrict date range
    document.addEventListener("DOMContentLoaded", function() {
      let today = new Date();
      let maxDate = new Date();
      maxDate.setDate(today.getDate() + 30);

      let minDate = today.toISOString().split('T')[0];
      let maxDateStr = maxDate.toISOString().split('T')[0];

      document.getElementById("date").setAttribute("min", minDate);
      document.getElementById("date").setAttribute("max", maxDateStr);

      document.getElementById("date").addEventListener("input", function(e) {
        let selectedDate = new Date(e.target.value);
        if (selectedDate.getDay() === 0) {
          alert("Appointments cannot be scheduled on Sundays.");
          e.target.setCustomValidity("Invalid date: Sunday");
        } else {
          e.target.setCustomValidity("");
        }
      });
    });
  </script>
</head>

<body>
  <main class="main-container">
    <div class="appointment-container">
      <h2>Book an Appointment</h2>
      <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo (isset($logged_fname))?$logged_fname:'';?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo (isset($logged_email))?$logged_email:'';?>" required>

        <label for="date">Select Appointment Date</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Select Appointment Time</label>
        <select id="time" name="time" required>
          <option value="08:00">08:00 AM</option>
          <option value="09:00">09:00 AM</option>
          <option value="10:00">10:00 AM</option>
          <option value="11:00">11:00 AM</option>
          <option value="12:00">12:00 PM</option>
          <option value="13:00">01:00 PM</option>
          <option value="14:00">02:00 PM</option>
          <option value="15:00">03:00 PM</option>
          <option value="16:00">04:00 PM</option>
        </select>

        <label for="notes">Additional Notes</label>
        <textarea id="notes" name="notes" placeholder="Any specific requests or questions?" rows="4"></textarea>
        <button type="submit">Submit Appointment</button>
		<a href="/" id="btnCancel">Cancel</a>
      </form>
    </div>

    <div class="rules-container">
      <h3>Rules & Regulations</h3>
      <ul>
        <li>Arrive at least 10 minutes before your scheduled time.</li>
        <li>No appointments on Sundays.</li>
        <li>Rescheduling must be requested 24 hours in advance.</li>
        <li>Only one guest is allowed to accompany the client.</li>
        <li>Please wear appropriate attire during fittings.</li>
        <li>No refunds for missed appointments.</li>
      </ul>
    </div>
  </main>
</body>
</html>
