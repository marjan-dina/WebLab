function validateForm() {
  const email = document.getElementById("email").value.trim();
  const studentId = document.getElementById("studentId").value.trim();
  const name = document.getElementById("name").value.trim();

  let valid = true;

  const emailPattern = /^[a-zA-Z0-9._%+-]+\.cse@diu\.edu\.bd$/;
  if (!emailPattern.test(email)) {
    document.getElementById("emailError").innerText = "Use yourname.cse@diu.edu.bd format only.";
    valid = false;
  } else {
    document.getElementById("emailError").innerText = "";
  }

  const idPattern = /^\d{3}-\d{2}-\d{4}$/;
  if (!idPattern.test(studentId)) {
    document.getElementById("idError").innerText = "Format must be ###-##-####.";
    valid = false;
  } else {
    document.getElementById("idError").innerText = "";
  }

  const namePattern = /^[A-Za-z\s]+$/;
  if (!namePattern.test(name)) {
    document.getElementById("nameError").innerText = "Only alphabets allowed in name.";
    valid = false;
  } else {
    document.getElementById("nameError").innerText = "";
  }

  return valid;
}
