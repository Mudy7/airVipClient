<template>

<transition name="dialog">
    <div class="boxAj dialog">
        <div>
            <div class = "enteteAj">
                Ajouter un aéroport
            </div>

            <div class="boxModifierAj">

                    <div class="titreSaisieAj">
                        Code IATA
                    </div>
                    <div class="boxsaisieAj">
                        <input v-model="codeIata" class = "barreSaisieAj" type="text" placeholder="Entrez votre texte ici" id="AA_iata">

                    </div>
        
            </div>

            <div class="boxModifierAj">

                    <div class="titreSaisieAj">
                        Ville
                    </div>

                    <div class="boxsaisieAj">
                        <input v-model="ville" class = "barreSaisieAj" type="text" placeholder="Entrez votre texte ici" id="AA_ville">

                    </div>
            
            </div>

            <div class="boxModifierAj">
                
                
                    <div class="titreSaisieAj">
                        Pays
                    </div>
                    
                    <div class="boxsaisieAj">
                        <input v-model="pays" class = "barreSaisieAj" type="text" placeholder="Entrez votre texte ici" id="AA_pays">

                    </div>
                
            </div>

            <div class="boxModifierAj">

                <div class="titreSaisieAj">
                    Distance de Montréal
                </div>
                    
                <div class="boxsaisieAj">
                    <input v-model="distance" class = "barreSaisieAj" type="text" placeholder="Entrez votre texte ici" id="AA_distance">

                </div>
            </div>

            <div>
                <button @click="ajAero"class="boutonConfirmerAj">Confirmer</button>
            </div>

            <button @click="$emit('fermer')" class="btnAnnulerAj">Annuler</button>
        </div>    
    </div>
</transition>
<div class="dialog-bg" @click="$emit('fermer')"></div>
</template>

<script>

import { post } from "../assets/utils/communications";
import { useDialog } from '../assets/utils/dialog.js';
import dialogBox from '../components/dialogBox.vue';

export default {
    name:"ajouterAero",
    data() {
        return {
        codeIata: '',
        ville: '',
        pays: '',
        distance: '',
        };
    },
    setup() {
        const dialog = useDialog();
        return { dialog };
    },
    methods: {
        async ajAero() {
            const body = {
                code_IATA: this.codeIata,
                ville: this.ville,
                pays: this.pays,
                distance_montreal: this.distance
            };

            console.log("Données à envoyer :", body); // Vérification

            const reponse = await post('aeroports', body);

            if(reponse.status===200){
                await this.dialog.alert('Ajout réussi !');
                //!!!!!!! RAFRAICHIR LA PAGE
                window.location.reload(true);
            } else {
                await this.dialog.alert('Erreur de l\'ajout');
            }
        }
    }
}

</script>



<style>

    .enteteAj{
        
        text-align: center;
        border-bottom: 3px solid rgb(65,65,65);
        font-size: 20px;
        font-weight: bold;
        background-color: rgb(96, 243, 96);
        padding: 5px 0px;
    }

    .btnAnnulerAj {
        border: 1px solid rgb(65,65,65);
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
        border: 1px solid rgb(65,65,65);
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
        border-bottom: 3px solid rgb(65,65,65);
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
        border: 2px solid rgb(65,65,65);
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

    
    .boxAj{

        justify-content: center;
        align-self: center;
        width: 480px;
        height: 470px;
        background-color: rgb(231, 251, 231);
        border: 3px solid rgb(65,65,65);
        
        border-radius: 5px;


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

