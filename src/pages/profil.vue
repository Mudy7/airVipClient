<template>
  <Navbar2 />
  <div class="relative min-h-screen overflow-auto">

    <!-- 🎬 Background Video -->
    <div class="absolute inset-0 z-0">
      <video class="w-full h-full object-cover fixed top-0 left-0" loop muted playsinline autoplay>
        <source
          src="https://player.vimeo.com/external/563130035.hd.mp4?s=5bd311f698519ffa90aa5136b96d1e86aa78d107&profile_id=175"
          type="video/mp4"
        />
      </video>
    </div>

    <!-- Contenu principal -->
    <div class="relative z-20 py-10 px-4 sm:px-6 lg:px-8">

    <!-- Section Mon Profil -->
    <section class="max-w-2xl mx-auto bg-white p-8 shadow-md rounded-lg mb-10">
      <div class="text-center mb-6">
        <h1 class="text-2xl font-bold">Mon Profil</h1>
      </div>

      <div class="space-y-5">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Adresse Courriel</label>
          <input v-model="email" :disabled="!isEditing"
                 class="w-full rounded-md border-gray-300 shadow-sm focus:ring-primary focus:border-primary p-3" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
          <input v-model="nom" :disabled="!isEditing"
                 class="w-full rounded-md border-gray-300 shadow-sm focus:ring-primary focus:border-primary p-3" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
          <input v-model="prenom" :disabled="!isEditing"
                 class="w-full rounded-md border-gray-300 shadow-sm focus:ring-primary focus:border-primary p-3" />
        </div>

        <div v-if="isEditing">
          <label class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
          <input v-model="newPassword" type="password" placeholder="Laissez vide pour ne pas modifier"
                 class="w-full rounded-md border-gray-300 shadow-sm focus:ring-primary focus:border-primary p-3" />
        </div>

        <div class="flex justify-between space-x-4 pt-4">
          <button v-if="!isEditing" @click="isEditing = true"
                  class="bg-[#F9BB12] text-white rounded-md px-4 py-2 hover:bg-blue-700 w-full">
            Modifier
          </button>
          <template v-if="isEditing">
            <button @click="updateProfile"
                    class="bg-green-600 text-white rounded-md px-4 py-2 hover:bg-green-700 w-full">
              Confirmer
            </button>
            <button @click="cancelEdit"
                    class="bg-gray-500 text-white rounded-md px-4 py-2 hover:bg-gray-600 w-full">
              Annuler
            </button>
          </template>
        </div>

        <div class="pt-6 text-center">
          <button @click="confirmDelete"
                  class="bg-red-600 text-white rounded-md px-4 py-2 hover:bg-red-700 w-full">
            Supprimer mon compte
          </button>
        </div>
      </div>
    </section>

    <!-- Section Mes Réservations -->
    <section class="max-w-4xl mx-auto bg-white p-8 shadow-md rounded-lg">
      <h2 class="text-xl font-semibold mb-6">Mes réservations</h2>

      <div v-if="reservations.length === 0" class="text-center text-gray-500">
        Vous n'avez aucune réservation pour le moment.
      </div>

      <div v-else class="space-y-6">
        <div v-for="res in reservations" :key="res.id" class="border rounded-md p-4 shadow-sm">
          <div class="flex flex-col lg:flex-row lg:space-x-6">
            <!-- Image -->
            <div class="lg:w-1/3 mb-4 lg:mb-0">
              <img :src="res.vol.avion.images[0]?.url || 'https://via.placeholder.com/300x200?text=Pas+image'"
                   alt="Image avion"
                   class="rounded-md w-full h-auto object-cover" />
            </div>

            <!-- Infos réservation -->
            <div class="lg:w-2/3 space-y-2">
              <p><strong>Modèle d’avion:</strong> {{ res.vol.avion.modele }}</p>
              <p><strong>Départ:</strong> {{ res.vol.aeroportDepart.ville }} ({{ res.vol.aeroportDepart.code_IATA }})</p>
              <p><strong>Destination:</strong> {{ res.vol.aeroportArrive.ville }} ({{ res.vol.aeroportArrive.code_IATA }})</p>
              <p><strong>Prix:</strong> {{ res.vol.prix }} $</p>
              <p><strong>Date de réservation:</strong> {{ new Date(res.dateReservation).toLocaleString() }}</p>

              <button @click="annulerReservation(res.id)"
                      class="mt-3 bg-red-500 text-white rounded-md px-4 py-2 hover:bg-red-600">
                Annuler cette réservation
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import { get, put, del } from "../assets/utils/communications.js";
import Navbar2 from "../components/navbar2.vue";

export default {
  name: "Profile",
  components: {
    Navbar2,
  },
  setup() {
    const email = ref("");
    const nom = ref("");
    const prenom = ref("");
    const newPassword = ref("");
    const isEditing = ref(false);
    const userId = localStorage.getItem("userId");
    const reservations = ref([]);

    const getReservations = async () => {
      try {
        const { status, body } = await get(`reservations/utilisateur/${userId}`);
        if (status === 200) {
          reservations.value = body;
        }
      } catch (error) {
        console.error("Erreur lors de la récupération des réservations :", error);
      }
    };

    onMounted(async () => {
      try {
        const { status, body } = await get(`utilisateurs/${userId}`);
        if (status === 200) {
          email.value = body.adresse_courriel;
          nom.value = body.nom;
          prenom.value = body.prenom;
          await getReservations();
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
        role: localStorage.getItem("role")
      };

      try {
        const { status, body } = await put(`utilisateurs/${userId}`, updatedData);
        if (status === 200) {
          email.value = body.adresse_courriel;
          nom.value = body.nom;
          prenom.value = body.prenom;
          newPassword.value = "";
          isEditing.value = false;
          alert("Modifications enregistrées !");
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
          localStorage.clear();
          alert("Compte supprimé avec succès.");
          window.location.href = "/";
        }
      } catch (error) {
        console.error("Erreur lors de la suppression du compte :", error);
      }
    };

    const annulerReservation = async (idReservation) => {
      if (confirm("Voulez-vous vraiment annuler cette réservation ?")) {
        try {
          const { status } = await del(`reservations/${idReservation}`);
          if (status === 204) {
            reservations.value = reservations.value.filter(res => res.id !== idReservation);
          }
        } catch (error) {
          console.error("Erreur lors de l'annulation :", error);
        }
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
      reservations,
      annulerReservation,
    };
  }
};
</script>
