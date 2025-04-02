<template>
    <Navbar class="w-full fixed top-0 left-0 z-20" />
    <div class="container">
        <button class="add-btn" @click="ajouterVol()">Ajouter Vol</button>
        <ajouterAero v-if="showAjouterAero" @fermer="showAjouterAero = false" />
        <table id="table-manager1" class="mb-30px">
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
                        <button class="edit-btn" @click="modifierVol(vol.vol_id)">Modifier</button>
                        <button class="delete-btn" @click="supprimerVol(vol.vol_id)">Supprimer</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="add-btn" @click="ajouterAeroport()">Ajouter Aeroport</button>
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
        <button class="add-btn" @click="ajouterAvion()">Ajouter Avion</button>
        <table id="table-manager3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modele</th>
                    <th>Capacite</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="avion in avionListe" :key="avion.avion_id">
                    <td>{{ avion.avion_id }}</td>
                    <td>{{ avion.modele }}</td>
                    <td>{{ avion.capacite }}</td>
                    <td>{{ avion.image }}</td>
                    <td>
                        <button class="edit-btn" @click="modifierAvion(avion.avion_id)">Modifier</button>
                        <button class="delete-btn" @click="supprimerAvion(avion.avion_id)">Supprimer</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <dialogBox/>
</template>

<style scoped>
.container {
    padding: 5px;
    padding-top: 50px;
    max-width: 1000px;
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
    text-align: center;
}
th {
    background-color: #f4f4f4;
    text-align:center;
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
.add-btn {
    background-color: aquamarine;
    color: black;
    margin-left:70%;
    margin-top:30px;
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
import { del } from "../assets/utils/communications";
import { useDialog } from '../assets/utils/dialog.js';
import dialogBox from '../components/dialogBox.vue';
import ajouterAero from "../components/ajouterAero.vue";
/*import ajouterVol from "../components/ajouterVol.vue";
/*import ajouterAvion from "../components/ajouterAvion.vue";

import modifierVol from "../components/modifierVol.vue";
import modifierAvion from "../components/modifierAvion.vue";
import modifierAero from "../components/modifierAero.vue";*/


export default {
  components: {
    Sidebar,
    Navbar,
    dropDown,
    InputText,
    dialogBox,
    ajouterAero,
    /*ajouterVol,
    ajouterAvion,
    ajouterAero,
    modifierVol,
    modifierAvion,
    modifierAero*/
  },
  setup() {
    const dialog = useDialog();
    return { dialog };
  },
  data() {
    return {
        aeroListe: [],
        volListe: [],
        avionListe: [],
        showAjouterAero: false,

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

    async supprimerAeroport(id_aeroport){
        
        const confirmed = await this.dialog
            .okText('Oui')
            .cancelText('Non')
            .confirm('Supprimer l\'aéroport #'+id_aeroport+' ?');

        if(confirmed){

            const confirm2 = await this.dialog
                .okText('Oui!')
                .cancelText('Finalement non')
                .confirm('Pour vrai de vrai ?\n Supprimer l\'aéroport #'+id_aeroport+' ?');

            if(confirm2){
                const response = await del('aeroports/'+id_aeroport);
                
                if(response.status===204){
                    await this.dialog.alert('Suppression réussie : aéroport '+id_aeroport);
                } else {
                    await this.dialog.alert('Erreur de suppression');
                }
            }
        }
    },

    async supprimerAvion(id_avion){

        const confirm1 = await this.dialog
            .okText('Oui')
            .cancelText('Non')
            .confirm('Supprimer l\'avion #'+id_avion+' ?');

        if(confirm1){

            const confirm2 = await this.dialog
                .okText('Oui !!!')
                .cancelText('Laisser faire')
                .confirm('Certain ? \nSupprimer l\'avion #'+id_avion+' ?');
            
            if(confirm2){
                const reponse = await del('avions/'+id_avion);

                if(reponse.status===204){
                    await this.dialog.alert('Suppression réussie : avion '+id_avion);
                } else {
                    await this.dialog.alert('Erreur de suppression');
                }
            }
        }
    },

    async supprimerVol(id_vol){
        
        const confirm1 = await this.dialog
            .okText('Oui')
            .cancelText('Non')
            .confirm('Supprimer le vol #'+id_vol+' ?');

        if(confirm1){

            const confirm2 = await this.dialog
                .okText('Oui !!!')
                .cancelText('Nan')
                .confirm('Sérieusement ? \nSupprimer le vol #'+id_vol+' ?');
            
            if(confirm2){
                const reponse = await del('vols/'+id_vol);

                if(reponse.status===204){
                    await this.dialog.alert('Suppression réussie : vol '+id_vol);
                } else {
                    await this.dialog.alert('Erreur de suppression');
                }
            }
        }
    },

    async ajouterAeroport(){
        // ouvrir un nouveau ajouterAero
        this.showAjouterAero = true;
        //!! changer les noms des éléments du DOM
        /*const codeIata = AA_iata
        const ville = AA_ville
        const pays = AA_pays
        const dist = AA_dist;

        const body = '{"code_IATA":"'+codeIata+'", "ville":"'+ville+'", "pays":"'+pays+'", "distance_montreal":"'+dist+'"}';

        // onSubmit()
        {
            const reponse = await post('aeroports', body);

        }
            */
    },
    async ajouterVol(){
        // ouvrir un nouveau ajouterVol
    },
    async ajouterAvion(){
        // ouvrir un nouveau ajouterAvion
    },

    async modifierAeroport(){
        // ouvrir un nouveau modifierAero
    },
    async modifierVol(){
        // ouvrir un nouveau modifierVol
    },
    async modifierAvion(){
        // ouvrir un nouveau modifierAvion
    },

  }
};
</script>