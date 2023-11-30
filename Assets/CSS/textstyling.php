<style>



.centered-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

.green-background {
  background-color: green;
  padding: 20px;
  color: white; /* Set text color to white for better visibility */
  border-radius: 10px; /* Rounded corners for the box */
}

.centered-form {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

/* Your existing styles */
.form-control {
  width: 300px; /* Adjust width as needed */
  padding: 10px;
  margin: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  outline: none;
}

/* New style for focus state */
.form-control:focus {
  border-color: green;
  box-shadow: 0 0 5px rgba(0, 255, 0, 0.5); /* Green shadow */
}

.btn {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}


</style>