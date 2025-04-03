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
        width: 500px;
        height: 500px;
        background-color: rgb(231, 251, 231);
        border: 3px solid grey;
        margin: 50px;
        border-radius: 4px;
        display: flex;
        flex-direction: column; /* Empile les éléments verticalement */
        align-items: center; /* Centre horizontalement */
        justify-content: flex-start; /* Aligne en haut */
    }

    .enteteVA{
        
        /*margin-bottom: 4px;*/
        text-align: center;
        width: 100%;
        border-bottom: 3px solid grey;
        font-size: 20px;
        font-weight: bold;
        background-color: rgb(96, 243, 96);
    }


    .boutonConfirmerVA {
        border: 2px solid grey;
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








    .boxModifierVA{
        width: 100%;
        flex: 1; /* Prend un quart de l'espace total */
        display: flex;
        flex-direction: row;
        padding: 10px 20px;
        border-bottom: 3px solid grey;
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
        border: 2px solid grey;
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

