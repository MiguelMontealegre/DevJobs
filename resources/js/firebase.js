// Import the functions you need from the SDKs you need
import firebase from './firebase'
import { initializeApp } from "firebase/app";
import { getFirestore, collection, addDoc, getDocs, getId, doc, get, getDoc, setDoc,updateDoc, arrayUnion, arrayRemove } from "firebase/firestore";



// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyDeEWlBMjNhFSi4uQNDiHmiYgAdupeOW4U",
    authDomain: "chat-devjobs.firebaseapp.com",
    projectId: "chat-devjobs",
    storageBucket: "chat-devjobs.appspot.com",
    messagingSenderId: "841718771840",
    appId: "1:841718771840:web:0828a6edee35a31daef665"
  };
  

// Initialize Firebase
const appFirebase = initializeApp(firebaseConfig);
const db = getFirestore();


//--------------------------------------------------------

//Funciones
//Agregar Sesion
export const saveSession = (sessionId, remitent, destiny, messages) => {
    addDoc(collection(db, "chat"), 
    {
        sessionId,
        remitent,
        destiny,
        messages
    }
    )}

//Agregar Dato
export const saveMessage = (id,dato) => {
     updateDoc(doc(db, "chat", id), {
        messages: arrayUnion(dato)
    })}

    
//Consultar Datos
export const getData = () => getDocs(collection(db, "chat"));

export const getDocById = (id) => getDoc(doc(db, "chat", id))