function validateLogin(event) {
  event.preventDefault();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (email === "rishi@gmail.com" && password === "1062") {
    alert("✅ Login successful!");
    window.location.href = "index.html";
  } else {
    alert("❌ Invalid email or password.");
  }
}
