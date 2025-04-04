<template>

    <transition name="dialog">
        <div class="boxVA dialog">
            <div class="heightboxVA">
                <div class = "enteteVA">
                    Ajout de vol
                </div>
    
                <div class="boxModifierVA">
    
                        <div class="titreSaisieVA">
                            Temps
                        </div>
                        <div class="boxsaisieVA">
                            <input v-model="temps" class = "barreSaisieVA" type="text" placeholder="Entrez votre texte ici" id="VA_temps">
    
                        </div>
            
                </div>
    
                <div class="boxModifierVA">
    
                        <div class="titreSaisieVA">
                            Disponibilité
                        </div>
    
                        <div class="boxsaisieVA">
                            <input v-model="disponibilite" class = "barreSaisieVA" type="text" placeholder="Entrez votre texte ici" id="VA_disponibilite">
    
                        </div>
                
                </div>
    
                <div class="boxModifierVA">
                    
                    
                        <div class="titreSaisieVA">
                            Nombre de place
                        </div>
                        
                        <div class="boxsaisieVA">
                            <input v-model="nb_place" class = "barreSaisieVA" type="text" placeholder="Entrez votre texte ici" id="VA_place">
    
                        </div>
                    
                </div>


                <div class="boxModifierVA">
                    
                    
                    <div class="titreSaisieVA">
                        Aeroport départ
                    </div>
                    
                    <select v-model="selectAeroDep">

                        <option v-for="aero in aero_list" :key="aero.id_aeroport" :value="aero.id_aeroport">{{ aero.ville }}</option>

                    </select>
                
                </div>

                <div class="boxModifierVA">
                    
                    
                    <div class="titreSaisieVA">
                        Aeroport arrivée
                    </div>
                    
                    <select  v-model="selectAeroArr">
                        <option v-for="aero in aero_list" :key="aero.id_aeroport" :value="aero.id_aeroport">{{ aero.ville }}</option>

                    </select>
                
            </div>

            <div class="boxModifierVA">
                    
                    
                    <div class="titreSaisieVA">
                        Avion
                    </div>
                    
                    <div class="boxsaisieVA">

                        <select  v-model="selectavion">

                            <option v-for="avion in avion_list" :key="avion.avion_id" :value="avion.avion_id">{{ avion.avion_id }} : {{ avion.modele }}</option>

                        </select>


                    </div>
                
            </div>
    

    
                <div class="classButtonVA">

    
                <button @click="$emit('fermer')" class="btnAnnulerVA">Annuler</button>
                <button @click="ajVol"class="boutonConfirmerVA">Confirmer</button>
                </div>
            </div>    
        </div>
    </transition>
    <div class="dialog-bg" @click="$emit('fermer')"></div>
    </template>
    
    <script>

        import { post, get } from "../assets/utils/communications";

        import { useDialog } from '../assets/utils/dialog.js';
        import dialogBox from '../components/dialogBox.vue';
  
        export default {
            name:"VAouterVol",
            data() {
                return {
                    temps: '',
                    disponibilite: '',
                    nb_place: '',
                    aero_list: '',
                    avion_list: '',
                    selectAeroArr: '',
                    selectAeroDep: '',
                    selectavion: ''
                };

            },

            setup() {
                const dialog = useDialog();
                return { dialog };
            },
            async mounted(){
            
                const response = await get('aeroports');
                this.aero_list = response.body;

                const reponse2 = await get('avions');
                this.avion_list = reponse2.body;

            
            },

            methods: {
        async ajVol() {
            
            const body = {
                temps: this.temps,
                disponibilite: this.disponibilite,
                nb_place: this.nb_place,
                fk_aeroport_arrivee: this.selectAeroArr,
                fk_aeroport_depart: this.selectAeroDep,
                fk_avion: this.selectavion
            };

            console.log("Données à envoyer :", body); // Vérification

            const reponse = await post('vols', body);

            if(reponse.status===201){
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


    .heightboxVA{
        display: flex;
        flex-direction: column;
        height: 100%;


    }

    .classButtonVA{
        display: flex;
        flex-direction: row; /* Empile les éléments en colonne */
        align-items: center; /* Centre horizontalement */
        gap: 20px; /* Espace entre les boutons */
        margin-top: auto;
        padding-left: 45px;
        
    }

    .boxVA {
        justify-content: center;
        align-self: center;
        width: 480px;
        height: 600px;
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

    .enteteVA{
        
        text-align: center;
        border-bottom: 3px solid rgb(65,65,65);
        font-size: 20px;
        font-weight: bold;
        background-color: rgb(96, 243, 96);
        padding: 5px 0px;   
    }


    .boutonConfirmerVA {
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

    .btnAnnulerVA {
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






    .boxModifierVA{
        flex: 1; /* Prend un quart de l'espace total */
        display: flex;
        flex-direction: row;
        padding: 20px;
        border-bottom: 3px solid rgb(65,65,65);
        border-top: 0px;
        justify-content: space-between;
        align-items: center;
    }




    .titreSaisieVA{
        flex: 1;                /*avoir*/
        display: flex;
        justify-content: center;
        font-size: 17px;
    }

    .barreSaisieVA{
        justify-content: flex-end;
        align-items: center;
        border: 2px solid rgb(65,65,65);
        align-self: center;
        border-radius: 3px;
        text-align: center;
        width: 200px;

    }

    .boxsaisieVA{
        flex: 1; /* Prend l'autre moitié de la largeur */
        display: flex;
        justify-content: center; /* Centre l'input horizontalement */
    }









</style>

