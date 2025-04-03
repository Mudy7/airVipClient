<template>
    <Navbar2 />
    <div class="flex flex-row h-screen">
      <div class="absolute top-5 left-5 cursor-pointer" @click="$router.push('/')">
        <img class="h-6 w-auto" src="/assets/icons/logo.png" alt="Logo" />
      </div>
      
      <section class="flex flex-1 lg:w-[60%] flex-col items-center justify-center px-12">
        <div class="w-full max-w-[24rem]">
          <div class="text-center">
            <span class="text-[28px]">Mon Profil</span>
          </div>
  
          <div class="pt-6">
            <div class="flex flex-col w-full">
              <label class="text-start pb-2 text-sm">Adresse Couriel</label>
              <input
                v-model="email"
                :disabled="!isEditing"
                class="outline-none w-full rounded-md border-0 py-3 px-5 bg-white text-gray-900 shadow-sm ring-1 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary"
              />
            </div>
  
            <div class="pt-5 flex flex-col w-full">
              <label class="text-start pb-2 text-sm">Nom</label>
              <input
                v-model="nom"
                :disabled="!isEditing"
                class="outline-none w-full rounded-md border-0 py-3 px-5 bg-white text-gray-900 shadow-sm ring-1 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary"
              />
            </div>
  
            <div class="pt-5 flex flex-col w-full">
              <label class="text-start pb-2 text-sm">Prénom</label>
              <input
                v-model="prenom"
                :disabled="!isEditing"
                class="outline-none w-full rounded-md border-0 py-3 px-5 bg-white text-gray-900 shadow-sm ring-1 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary"
              />
            </div>
  
            <div v-if="isEditing" class="pt-5 flex flex-col w-full">
              <label class="text-start pb-2 text-sm">Nouveau mot de passe</label>
              <input
                v-model="newPassword"
                type="password"
                placeholder="Laissez vide pour ne pas modifier"
                class="outline-none w-full rounded-md border-0 py-3 px-5 bg-white text-gray-900 shadow-sm ring-1 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary"
              />
            </div>
  
            <div class="pt-7 flex justify-between">
              <button
                v-if="!isEditing"
                class="bg-primary btn-hover cursor-pointer rounded-lg text-white p-3 w-1/2"
                @click="isEditing = true"
              >
                Modifier
              </button>
              <button
                v-if="isEditing"
                class="bg-green-600 btn-hover cursor-pointer rounded-lg text-white p-3 w-1/2"
                @click="updateProfile"
              >
                Confirmer
              </button>
              <button
                v-if="isEditing"
                class="bg-gray-500 btn-hover cursor-pointer rounded-lg text-white p-3 w-1/2 ml-2"
                @click="cancelEdit"
              >
                Annuler
              </button>
            </div>
  
            <div class="pt-5 text-center">
              <button
                class="bg-red-600 btn-hover cursor-pointer rounded-lg text-white p-3 w-full"
                @click="confirmDelete"
              >
                Supprimer mon compte
              </button>
            </div>
          </div>
        </div>
      </section>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from "vue";
  import { get, put, del } from "../assets/utils/communications.js";
import Navbar2 from "../components/navbar2.vue";
import DropDown from "../components/dropDown.vue";
  
  export default {
    name: "Profile",
    components: {
    Navbar2,
    DropDown,
  },
    setup() {
      const email = ref("");
      const nom = ref("");
      const prenom = ref("");
      const newPassword = ref("");
      const isEditing = ref(false);
      const userId = localStorage.getItem("userId");
  
      onMounted(async () => {
        try {
          const { status, body } = await get(`utilisateurs/${userId}`);
          if (status === 200) {
            email.value = body.adresse_courriel;
            nom.value = body.nom;
            prenom.value = body.prenom;
          }
        } catch (error) {
          console.error("Erreur de récupération du profil :", error);
        }
      });
  
      const updateProfile = async () => {
        const updatedData = {
            adresse_courriel: email.value,
            nom: nom.value,
            prenom: prenom.value,
            mot_de_passe: newPassword.value.trim() !== "" ? newPassword.value : undefined,
            role: localStorage.getItem("role") // Récupérer le rôle du localStorage et l'envoyer
        };

        try {
            const { status, body } = await put(`utilisateurs/${userId}`, updatedData);
            if (status === 200) {
            email.value = body.adresse_courriel;
            nom.value = body.nom;
            prenom.value = body.prenom;
            newPassword.value = "";
            isEditing.value = false;
            alert("Modifications enregistrées!");
            }
        } catch (error) {
            console.error("Erreur lors de la mise à jour du profil :", error);
        }
        };
  
      const cancelEdit = () => {
        isEditing.value = false;
        newPassword.value = "";
      };
  
      const confirmDelete = () => {
        if (confirm("Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.")) {
          deleteAccount();
        }
      };
  
      const deleteAccount = async () => {
        try {
          const { status } = await del(`utilisateurs/${userId}`);
          if (status === 204) {
            localStorage.removeItem("token");
            localStorage.removeItem("userId");
            localStorage.removeItem("role");
            alert("Compte supprimé avec succès.");
            window.location.href = "/";
          }
        } catch (error) {
          console.error("Erreur lors de la suppression du compte :", error);
        }
      };
  
      return {
        email,
        nom,
        prenom,
        newPassword,
        isEditing,
        updateProfile,
        cancelEdit,
        confirmDelete,
      };
    },
  };
  </script>
  
  <style scoped></style>
  