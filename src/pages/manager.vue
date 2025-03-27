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
import CarteAero from "../components/carteAero.vue";
import InputText from 'primevue/inputtext';
import { get } from "../assets/utils/communications";


export default {
  components: {
    Sidebar,
    Navbar,
    dropDown,
    InputText,
    CarteAero,
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
    this.aeroGetCode(4);
    
  },
  mounted(){
  },
  methods: {
    async aeroportGet(){
        const response = await get('aeroports');
        this.aeroListe = response.body; 
        //console.log('dans aeroportGet'+response.body);
    },
    carteAeroTexte(id) {
      const codeIata = this.aeroGetCode(id) || "Unknown";
      const ville = this.aeroGetVille(id) || "Unknown";
      const pays = this.volGetPays(id) || "Unknown";
      const dist = this.volGetDist(id) || "Unknown";

      return `Aeroport ${id} code IATA:${codeIata} ville:${ville}
             pays:${pays} distance de Montréal:${dist}`;
    },
    aeroGetCode(id){
        const obj = JSON.parse(this.aeroListe);
        //console.log('dans aeroGetCode'+this.aeroListe);
        //const obj = JSON.parse('[ { "id_aeroport": 1, "code_IATA": "LDN", "ville": "Londres", "pays": "Royaume-Uni", "distance_montreal": 2500 }, { "id_aeroport": 2, "code_IATA": "MEX", "ville": "Mexico", "pays": "Mexique", "distance_montreal": 1250 }, { "id_aeroport": 4, "code_IATA": "PAR", "ville": "Paris", "pays": "France", "distance_montreal": 2000 } ]');

        const aeroport = obj.find(a => a.id_aeroport === id);
        if (aeroport) {
            this.aeroportTest = aeroport.code_IATA;
        } else {
            console.error("Aéroport non trouvé !");
        }
    },
    aeroGetVille(id){
        const aero = this.getAeroHtml(id);
        return aero['ville'];
    },
    aeroGetPays(id){
        const aero = this.getAeroHtml(id);
        return aero['pays'];
    },
    aeroGetDist(id){
        const aero = this.getAeroHtml(id);
        return aero['distance_montreal'];
    },

    async volGet(){
        const response = await get('vols');
        this.volListe = response.body; 
    },

    async avionGet(){
        const response = await get('avions');
        this.avionListe = response.body; 
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