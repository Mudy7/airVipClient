<template>
    <!--NavBar-->
    <Navbar class="w-full fixed top-0 left-0 z-20" />

    <!--Table Selector-->
    <div>
        <div id="entete-manager">

        </div>
        <div id="corps-manager">
            <!--Liste des éléments modifiables, avion, aéroport, vol-->
            <!--Cliquer dessus change la page pour montrer la liste d'éléments de la table-->
            <!--Change aussi l'entete-->
            <table id="table-manager">
                <td class="p-30">{{ this.aeroportTest }}</td>
            </table>
        </div>
    </div>

</template>

<style lang="css">
.table-manager {
    display:flex;
    align-items: center;
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
        aeroListe: "",
        volListe: "",
        avionListe: "",
        aeroportTest: "",
    };
  },
  beforeMount() {
    this.aeroportGet();
    this.volGet();
    this.avionGet();
  },
  mounted(){
    this.carteAeroTexte(1);
  },
  methods: {
    async aeroportGet(){
        const response = await get('aeroports');
        this.aeroListe = response.body; 
        return this.aeroListe;
        //console.log('dans aeroportGet'+response.body);
    },
    async aeroGetCode(id){
        const response = await get('aeroports');
        const aero = response.body; 
        
        const aeroport = aero.find(a => a.id_aeroport === id);

        if (aeroport) {
            return aeroport.code_IATA;
        } else {
            console.error("Aéroport non trouvé !");
        }
    },
    async aeroGetVille(id){
        const response = await get('aeroports');
        const aero = response.body;
        console.log(aero); 
        
        const aeroport = aero.find(a => a.id_aeroport === id);
        console.log(aeroport);
        if (aeroport) {
            console.log(aeroport.ville);
            return aeroport.ville;
        } else {
            console.error("Aéroport non trouvé !");
        }
    },
    async aeroGetPays(id){
        const response = await get('aeroports');
        const aero = response.body; 
        
        const aeroport = aero.find(a => a.id_aeroport === id);

        if (aeroport) {
            return aeroport.pays;
        } else {
            console.error("Aéroport non trouvé !");
        }
    },
    async aeroGetDist(id){
        const response = await get('aeroports');
        const aero = response.body; 
        
        const aeroport = aero.find(a => a.id_aeroport === id);

        if (aeroport) {
            return aeroport.distance_montreal;
        } else {
            console.error("Aéroport non trouvé !");
        }
    },

    async volGet(){
        const response = await get('vols');
        this.volListe = response.body; 
    },

    async avionGet(){
        const response = await get('avions');
        this.avionListe = response.body; 
    },

    async carteAeroTexte(id) {
      const codeIata = await this.aeroGetCode(id) || "Unknown";
      const ville = await this.aeroGetVille(id) || "Unknown";
      const pays = await this.aeroGetPays(id) || "Unknown";
      const dist = await this.aeroGetDist(id) || "Unknown";
      console.log(id+' '+codeIata+' '+ville+' '+pays+' '+dist);
      return `Aeroport ${id} code IATA:${codeIata} ville:${ville}
             pays:${pays} distance de Montréal:${dist}`;
    },

    carteVolTexte(id) {
      const depart = volGetDepart(id) || "Unknown";
      const arrivee = volGetArrivee(id) || "Unknown";
      const date = volGetDate(id) || "Unknown";
      const time = volGetTime(id) || "Unknown";

      return `Vol ${id} départ:${depart} arrivée:${arrivee}
             date:${date} time:${time}`;
      
    },
    volGetDepart(id){
        const vol = this.getVolHtml(id);
        return vol['FK_Aeroport_depart'];
    },
    volGetArrivee(id){
        const vol = this.getVolHtml(id);
        return vol['FK__Aeroport_arrive'];
    },
    volGetTemps(id){
        const vol = this.getVolHtml(id);
        return vol['temps'];
    },
  }
};
</script>