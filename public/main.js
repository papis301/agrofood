// Config Firebase



// Observer l'état de connexion
// auth.onAuthStateChanged(user => {
//     if (user) {
//         loginBtn.style.display = 'none';
//         logoutBtn.style.display = 'block';
//         userInfo.innerHTML = `
//             <p>Connecté en tant que : ${user.displayName}</p>
//             <p>Email : ${user.email}</p>
//             <img src="${user.photoURL}" width="100"/>
//         `;
//     } else {
//         loginBtn.style.display = 'block';
//         logoutBtn.style.display = 'none';
//         userInfo.innerHTML = '';
//     }
// });
// main.js
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
import { getAuth, GoogleAuthProvider, signInWithPopup, signOut, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-auth.js";

// 🔹 Configuration Firebase (remplace par tes propres valeurs)
const firebaseConfig = {
  apiKey: "AIzaSyARfM5_QDtjHvpBcn55OcfskO9BSbrFILE",
  authDomain: "its2025.firebaseapp.com",
  projectId: "its2025",
  storageBucket: "its2025.firebasestorage.app",
  messagingSenderId: "471440425690",
  appId: "1:471440425690:web:d975b9cf4bfb5363e5dbe3",
  measurementId: "G-VDK8ESXS23"
};


// Initialisation Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const provider = new GoogleAuthProvider();

// Récupération des éléments HTML
const loginBtn = document.getElementById("loginBtn");
const logoutBtn = document.getElementById("logoutBtn");
const userInfo = document.getElementById("userInfo");
const extraInfo = document.getElementById("extraInfo");
const savePhoneBtn = document.getElementById("savePhoneBtn");
const phoneInput = document.getElementById("phone");

// Connexion Google
loginBtn.addEventListener("click", () => {
  signInWithPopup(auth, provider)
    .then(result => {
      console.log("Connexion réussie :", result.user);
    })
    .catch(error => {
      console.error("Erreur connexion :", error);
    });
});

// Déconnexion
logoutBtn.addEventListener("click", () => {
  signOut(auth).then(() => {
    console.log("Déconnecté");
  });
});

// Vérifier état de connexion
onAuthStateChanged(auth, user => {
  if (user) {
    loginBtn.style.display = "none";
    logoutBtn.style.display = "inline-block";
    userInfo.innerHTML = `
      <p>Connecté en tant que : <strong>${user.displayName}</strong></p>
      <p>Email : ${user.email}</p>
      <p>idfb : ${user.uid}</p>
      <img src="${user.photoURL}" width="100"/>
    `;

    // Si pas de téléphone enregistré chez Google → afficher formulaire
    if (!user.phoneNumber) {
      extraInfo.style.display = "block";
    } else {
      extraInfo.style.display = "none";
      syncMembre(user.email, user.displayName, user.phoneNumber);
    }

  } else {
    loginBtn.style.display = "inline-block";
    logoutBtn.style.display = "none";
    userInfo.innerHTML = "";
    extraInfo.style.display = "none";
  }
});

// Fonction pour envoyer les données à Symfony
function syncMembre(email, username, phone) {
  fetch("/firebase/sync-membre", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      email: email,
      username: username,
      phone: phone
    })
  })
  .then(res => res.json())
  .then(data => {
    console.log("Réponse Symfony :", data);
  })
  .catch(err => console.error("Erreur serveur :", err));
}

// Sauvegarde du téléphone saisi par l’utilisateur
savePhoneBtn.addEventListener("click", () => {
  const phone = phoneInput.value.trim();
  if (phone === "") {
    alert("Veuillez entrer un numéro de téléphone !");
    return;
  }

  const user = auth.currentUser;
  if (user) {
    syncMembre(user.email, user.displayName, phone);
    alert("Numéro enregistré !");
    extraInfo.style.display = "none";
  }
});
