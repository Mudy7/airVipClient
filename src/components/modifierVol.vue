<template>






    <div class="boxVM">

        <div class = "enteteVM">
            Modification du vol
        </div>
        <div class="boxVMModifierVM1">

            <div class="actionModifVM">
                <div class="titreSaisieVM">
                    Temps du vol
                </div>
                <input class = "barreSaisieVM" type="text" placeholder="Entrez votre texte ici" id="VM_temps">

            </div>


            <button class="boutonConfirmerVM">Confirmer</button>
        </div>
        <div class="boxVMModifierVM">

            <div class="actionModifVM">

                <div class="titreSaisieVM">
                    Disponibilité
                </div>

                <input class = "barreSaisieVM" type="text" placeholder="Entrez votre texte ici" id="VM_disponibilite">

            </div>

            <button class="boutonConfirmerVM">Confirmer</button>
        </div>
        <div class="boxVMModifierVM">
            
            <div class="actionModifVM">
                <div class="titreSaisieVM">
                    Nombre de place
                </div>
                
                <input class = "barreSaisieVM" type="text" placeholder="Entrez votre texte ici" id="VM_place">

            </div>

            <button class="boutonConfirmerVM">Confirmer</button>
        </div>



    </div>




</template>

<script>
export default {
    name:"modifierVol"
  }
</script>



<style>
    .boxVM {
        justify-content: center;
        align-self: center;
        width: 500px;
        height: 500px;
        background-color: rgb(252, 252, 213);
        border: 3px solid grey;
        margin: 50px;
        border-radius: 4px;
        display: flex;
        flex-direction: column; /* Empile les éléments verticalement */
        align-items: center; /* Centre horizontalement */
        justify-content: flex-start; /* Aligne en haut */
    }

    .enteteVM{

        background-color: rgb(246, 246, 92);

        text-align: center;
        width: 100%;
        border-bottom: 3px solid grey;
        font-size: 20px;
        font-weight: bold;
    }


    .boutonConfirmerVM {
        border: 1px solid grey;
        border-radius: 4px;
        background-color: lightskyblue;
        padding: 8px 18px;
        font-size: 15px;
        margin-top: 5px;
        margin-bottom: 5px;
        align-self: center; /* Centre le bouton verticalement dans boxVMModifierVM1 */
        width: 185px;
        cursor: pointer;
        
    }




    .boxVMModifierVM1 {
        width: 100%;
        flex: 1; /* Prend un quart de l'espace total */
        display: flex;
        justify-content: flex-end; /* Aligné à droite */
        align-items: center; /* Centré verticalement */
        padding-right: 20px;
    }




    .boxVMModifierVM{
        width: 100%;
        flex: 1; /* Prend un quart de l'espace total */
        display: flex;
        justify-content: flex-end; /* Aligné à droite */
        align-items: center; /* Centré verticalement */
        padding-right: 20px;
        border-top: 3px solid grey
    }


    .actionModifVM{

        justify-content: center;
        display: flex;
        flex-direction: column;
        padding-right: 45px;
        
    }

    .titreSaisieVM{

        font-size: 17px;
        
    }

    .barreSaisieVM{
        margin-top: 13px;
        margin-bottom: 6px;
        border: 2px solid grey;
        align-self: center;
        border-radius: 2px;
        text-align: center;
        width: 200px;

    }










</style>

