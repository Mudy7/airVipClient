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
                <td class="p-10">{{ this.aero }}</td>
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
        aero: "",
    };
  },
  beforeMount() {
    this.aeroportGet();
  },
  methods: {
    carteVolTexte(id) {
      const depart = volGetDepart(id) || "Unknown";
      const arrivee = volGetArrivee(id) || "Unknown";
      const date = volGetDate(id) || "Unknown";
      const time = volGetTime(id) || "Unknown";

      return `Vol ${id} départ:${depart} arrivée:${arrivee}
             date:${date} time:${time}`;
      
    },
    getVolHtml(id){
        const xhr = new XMLHttpRequest();
        if(id!==null){
            xhr.open("GET", "http://127.0.0.1:8081/vols/"||`${id}`);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onload = () => {
                if (xhr.readyState == 4 && xhr.status == 201) 
                {
                    return JSON.parse(xhr.responseText); // retourne un seul vol
                } else 
                {
                    console.log(`Error: ${xhr.status}`);
                }
            };
            xhr.send();
        }else{
            xhr.open("GET", "http://127.0.0.1:8081/vols");
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onload = () => {
                if (xhr.readyState == 4 && xhr.status == 201) 
                {
                    return JSON.parse(xhr.responseText); // retourne l'ensemble des vols
                } else 
                {
                    console.log(`Error: ${xhr.status}`);
                }
            };
            xhr.send();
        }
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
    carteAeroTexte(id) {
      const codeIata = this.aeroGetCode(id) || "Unknown";
      const ville = this.aeroGetVille(id) || "Unknown";
      const pays = this.volGetPays(id) || "Unknown";
      const dist = this.volGetDist(id) || "Unknown";

      return `Aeroport ${id} code IATA:${codeIata} ville:${ville}
             pays:${pays} distance de Montréal:${dist}`;
    },
    getAeroHtml(id){
        const xhr = new XMLHttpRequest();
        if(id!==null){
            xhr.open("GET", "http://127.0.0.1:8081/aeroports/"+`${id}`);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
            xhr.setRequestHeader("Access-Control-Allow-Methods", "GET,POST,PUT,DELETE");
            xhr.onload = () => {
                if (xhr.readyState == 4 && xhr.status == 201) 
                {
                    return JSON.parse(xhr.responseText); // retourne un seul 
                } else 
                {
                    console.log(`Error: ${xhr.status}`);
                }
            };
            xhr.send();
        }else{
            xhr.open("GET", "http://127.0.0.1:8081/aeroports");
            //xhr.setRequestHeader("Content-Type", "application/json");
            //xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
            //xhr.setRequestHeader("Access-Control-Allow-Methods", "GET,POST,PUT,DELETE");
            xhr.onload = () => {
                if (xhr.readyState == 4 && xhr.status == 201) 
                {
                    return JSON.parse(xhr.responseText); // retourne l'ensemble
                } else 
                {
                    console.log(`Error: ${xhr.status}`);
                }
            };
            xhr.send();
        }
    },
    aeroGetCode(id){
        const aero = this.getAeroHtml(id);
        return aero['code_IATA'];
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
    async aeroportGet(id){
        this.aero = await get('aeroports/1');
    }
  }
};
</script>