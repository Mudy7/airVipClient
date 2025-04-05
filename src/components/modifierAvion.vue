<template>

<transition name="dialog">
        <div class="boxModAvion dialog">
            <div>
                <div class = "enteteModAvion">
                    Modifier un avion
                </div>
    
                <div class="boxModifierAj">
    
                        <div class="titreSaisieAj">
                            Modele
                        </div>
                        <div class="boxsaisieAj">
                            <input v-model="modele" class = "barreSaisieAj" type="text" placeholder="Chargement..." id="AA_iata">
    
                        </div>
            
                </div>
    
                <div class="boxModifierAj">
    
                        <div class="titreSaisieAj">
                            Capacite
                        </div>
    
                        <div class="boxsaisieAj">
                            <input v-model="capacite" class = "barreSaisieAj" type="text" placeholder="Chargement..." id="AA_ville">
    
                        </div>
                
                </div>

                <div class="boxModifierAj">
    
                    <div class="titreSaisieAj">
                        Image
                    </div>

                    <select>
                        <option v-for="image in imgListe">{{image.url}}</option>
                    </select>

                </div>
    
                <div>
                    <button @click="modAvion"class="boutonConfirmerAj">Confirmer</button>
                </div>
    
                <button @click="$emit('fermer')" class="btnAnnuler">Annuler</button>
            </div>
        </div>
</transition>
    <div class="dialog-bg" @click="$emit('fermer')"></div>
</template>
    
<script>
import { get } from "../assets/utils/communications";
import { put } from "../assets/utils/communications";
import { useDialog } from '../assets/utils/dialog.js';
import dialogBox from '../components/dialogBox.vue';

export default {
    name:"modifierAvion",
    props: ["id_avion"],
data() {
    return {
        modele: '',
        capacite: '',
        imgListe: [],
    };
},
async mounted(){
    if(this.id_avion){
        const reponse = await get('avions/'+this.id_avion);
        const data = reponse.body;
        this.modele = data.modele;
        this.capacite = data.capacite;
    }
    const response = await get('vols');
    this.imgListe = response.body[0].avion.images || [];
},
setup() {
    const dialog = useDialog();
    return { dialog };
},
methods: {
    async modAvion(id_avion) {
        const body = {
            modele: this.modele,
            capacite: this.capacite,
        };

        console.log("Données à envoyer :", body); // Vérification

        const reponse = await put('avions/'+id_avion, body);

        if(reponse.status===200){
            await this.dialog.alert('Modification réussie !');
            //!!!!!!! RAFRAICHIR LA PAGE
            window.location.reload(true);
        } else {
            await this.dialog.alert('Erreur de modification');
        }
    }
}
}
    
</script>
    
    
    
    <style>
    
        .enteteModAvion{
            
            text-align: center;
            border-bottom: 3px solid grey;
            font-size: 20px;
            font-weight: bold;
            background-color: rgb(246, 246, 92);
            padding: 5px 0px;
        }
    
        .btnAnnuler {
            border: 1px solid grey;
            border-radius: 4px;
            background-color: rgb(255, 184, 184);
            padding: 8px 18px;
            font-size: 15px;
            margin-top: 13px;
            margin-bottom: 13px;
            align-self: center; /* Centre le bouton verticalement dans boxModifier1 */
            width: 185px;
            cursor: pointer;
        }
    
        .boutonConfirmerAj {
            border: 1px solid grey;
            border-radius: 4px;
            background-color: lightskyblue;
            padding: 8px 18px;
            font-size: 15px;
            margin-top: 13px;
            margin-bottom: 13px;
            align-self: center; /* Centre le bouton verticalement dans boxModifier1 */
            width: 185px;
            cursor: pointer;
            
        }
    
        .boxModifierAj{
            flex: 1; /* Prend un quart de l'espace total */
            display: flex;
            flex-direction: row;
            padding: 20px;
            border-bottom: 3px solid grey;
            border-top: 0px;
            justify-content: space-between;
            align-items: center;
        }
    
        .titreSaisieAj{
    
            flex: 1;                /*avoir*/
            display: flex;
            justify-content: center;
            font-size: 17px;
            
            
        }
    
        .barreSaisieAj{
            justify-content: flex-end;
            align-items: center;
            border: 2px solid grey;
            align-self: center;
            border-radius: 3px;
            text-align: center;
            width: 200px;
    
        }
    
        .boxsaisieAj{
            
            flex: 1; /* Prend l'autre moitié de la largeur */
            display: flex;
            justify-content: center; /* Centre l'input horizontalement */
        }
    
    
    
        .dialog {
            transition: 0.3s ease all;
        }
        .dialog-enter .dialog-bg {
            opacity: 0;
        }
        
        .dialog-leave-active .dialog-bg {
            opacity: 0;
        }
        
        .dialog-enter .dialog-inner,
        .dialog-leave-active .dialog-inner {
            opacity: 0;
            transform: translateY(-50px) translateX(-50%);
        }
        .dialog-bg {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            opacity: 1;
            transition: all 0.3s ease;
        }
    
        
        .boxModAvion{
    
            justify-content: center;
            align-self: center;
            width: 600px;
            height: 350px;
            background-color: rgb(252, 252, 213);
            border: 3px solid grey;
            
            border-radius: 4px;
    
    
            will-change: contents;
            transform-origin: center;
            transition: all 0.3s ease-out;
            padding:0px;
            z-index: 2;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
    
            opacity: 1;
    }
    
        
    </style>
    
    