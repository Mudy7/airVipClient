<template>
    <Navbar class="w-full fixed top-0 left-0 z-20" />
    <div class="container">
        <table id="table-manager1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prix</th>
                    <th>Temps</th>
                    <th>Disponibilite</th>
                    <th>Nombre places</th>
                    <th>Arrivée</th>
                    <th>Départ</th>
                    <th>Avion</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="vol in volListe" :key="vol.vol_id">
                    <td>{{ vol.vol_id }}</td>
                    <td>{{ vol.prix }}</td>
                    <td>{{ vol.temps }}</td>
                    <td>{{ vol.disponibilite }}</td>
                    <td>{{ vol.nb_place }}</td>
                    <td>{{ vol.FK_Aeroport_arrivee }}</td>
                    <td>{{ vol.FK_Aeroport_depart }}</td>
                    <td>{{ vol.FK_avion }}</td>
                    <td>
                        <button class="edit-btn" @click="modifierAeroport(aeroport.id_aeroport)">Modifier</button>
                        <button class="delete-btn" @click="supprimerAeroport(aeroport.id_aeroport)">Supprimer</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <table id="table-manager2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code IATA</th>
                    <th>Ville</th>
                    <th>Pays</th>
                    <th>Distance (km)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="aeroport in aeroListe" :key="aeroport.id_aeroport">
                    <td>{{ aeroport.id_aeroport }}</td>
                    <td>{{ aeroport.code_IATA }}</td>
                    <td>{{ aeroport.ville }}</td>
                    <td>{{ aeroport.pays }}</td>
                    <td>{{ aeroport.distance_montreal }}</td>
                    <td>
                        <button class="edit-btn" @click="modifierAeroport(aeroport.id_aeroport)">Modifier</button>
                        <button class="delete-btn" @click="supprimerAeroport(aeroport.id_aeroport)">Supprimer</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <table id="table-manager3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modele</th>
                    <th>Capacite</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="avion in avionListe" :key="avion.avion_id">
                    <td>{{ avion.avion_id }}</td>
                    <td>{{ avion.modele }}</td>
                    <td>{{ avion.capacite }}</td>
                    <td>
                        <button class="edit-btn" @click="modifierAeroport(aeroport.id_aeroport)">Modifier</button>
                        <button class="delete-btn" @click="supprimerAeroport(aeroport.id_aeroport)">Supprimer</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>
.container {
    padding: 5px;
    padding-top: 50px;
    max-width: 800px;
    margin: auto;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}
th {
    background-color: #f4f4f4;
}
button {
    padding: 5px 10px;
    border: none;
    cursor: pointer;
}
.edit-btn {
    background-color: #ffc107;
    color: black;
    margin-right: 5px;
}
.delete-btn {
    background-color: #dc3545;
    color: white;
}
button:hover {
    opacity: 0.8;
}
</style>

<script>
import Sidebar from "../components/sidebar.vue";
import Navbar from "../components/navbar2.vue";
import dropDown from "../components/dropDown.vue";
import InputText from 'primevue/inputtext';
import { get } from "../assets/utils/communications";


export default {
  components: {
    Sidebar,
    Navbar,
    dropDown,
    InputText,
  },
  data() {
    return {
        aeroListe: [],
        volListe: [],
        avionListe: [],
    };
  },
  async mounted(){
    this.aeroListe = await this.aeroportGet();
    this.avionListe = await this.avionGet();
    this.volListe = await this.volGet();
  },
  methods: {
    async aeroportGet(){
        const response = await get('aeroports');
        return response.body || [];
    },
    
    async volGet(){
        const response = await get('vols');
        return response.body || []; 
    },

    async avionGet(){
        const response = await get('avions');
        return response.body || []; 
    },

  }
};
</script>