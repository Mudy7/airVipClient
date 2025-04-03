<template>

    <div class="boxVA">

        <div class = "enteteVA">
            Ajouter de Vol
        </div>



        <div class="boxModifierVA">

            
                <div class="titreSaisieVA">
                    Temps du vol
                </div>
                <div class="boxsaisieVA">
                    <input class = "barreSaisieVA" type="text" placeholder="Entrez votre texte ici" id="VA_temps">

                </div>
            



        </div>


        <div class="boxModifierVA">

           

                <div class="titreSaisieVA">
                    Disponibilité
                </div>

                <div class="boxsaisieVA">
                    <input class = "barreSaisieVA" type="text" placeholder="Entrez votre texte ici" id="VA_disponibilite">

                </div>
           


        </div>


        <div class="boxModifierVA">
            
            
                <div class="titreSaisieVA">
                    Nombre de place
                </div>
                
                <div class="boxsaisieVA">
                    <input class = "barreSaisieVA" type="text" placeholder="Entrez votre texte ici" id="VA_place">

                </div>
            

        </div>




        <div>
            <button class="boutonConfirmerVA">Confirmer</button>
        </div>

    </div>




</template>

<script>
export default {
    name:"ajouterVol"
  }
</script>



<style>
    .boxVA {
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

