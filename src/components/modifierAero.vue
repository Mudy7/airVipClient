<template>






    <div class="box">

        <div class = "entete">
            Modification de l'aéroport
        </div>
        <div class="boxModifier1">

            <div class="actionModif">
                <div class="titreSaisie">
                    Code IATA
                </div>
                <input class = "barreSaisie" type="text" placeholder="Entrez votre texte ici" id="AM_iata">

            </div>


            <button class="boutonConfirmer">Confirmer</button>
        </div>
        <div class="boxModifier">

            <div class="actionModif">

                <div class="titreSaisie">
                    Ville
                </div>

                <input class = "barreSaisie" type="text" placeholder="Entrez votre texte ici" id="AM_ville">

            </div>

            <button class="boutonConfirmer">Confirmer</button>
        </div>
        <div class="boxModifier">
            
            <div class="actionModif">
                <div class="titreSaisie">
                    Pays
                </div>
                
                <input class = "barreSaisie" type="text" placeholder="Entrez votre texte ici" id="AM_pays">

            </div>

            <button class="boutonConfirmer">Confirmer</button>
        </div>
        <div class="boxModifier">
            
            <div class="actionModif">

                <div class="titreSaisie">
                    Distance de Montréal
                </div>
                
                <input class = "barreSaisie" type="text" placeholder="Entrez votre texte ici" id="AM_distance">

            </div>

            <button class="boutonConfirmer">Confirmer</button>
        </div>


    </div>




</template>

<script>

</script>



<style>
    .box {
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

    .entete{

        background-color: rgb(246, 246, 92);

        text-align: center;
        width: 100%;
        border-bottom: 3px solid grey;
        font-size: 20px;
        font-weight: bold;
    }


    .boutonConfirmer {
        border: 1px solid grey;
        border-radius: 4px;
        background-color: lightskyblue;
        padding: 8px 18px;
        font-size: 15px;
        margin-top: 5px;
        margin-bottom: 5px;
        align-self: center; /* Centre le bouton verticalement dans boxModifier1 */
        width: 185px;
        cursor: pointer;
        
    }




    .boxModifier1 {
        width: 100%;
        flex: 1; /* Prend un quart de l'espace total */
        display: flex;
        justify-content: flex-end; /* Aligné à droite */
        align-items: center; /* Centré verticalement */
        padding-right: 20px;
    }




    .boxModifier{
        width: 100%;
        flex: 1; /* Prend un quart de l'espace total */
        display: flex;
        justify-content: flex-end; /* Aligné à droite */
        align-items: center; /* Centré verticalement */
        padding-right: 20px;
        border-top: 3px solid grey
    }


    .actionModif{

        justify-content: center;
        display: flex;
        flex-direction: column;
        padding-right: 45px;
        
    }

    .titreSaisie{

        font-size: 17px;
        
    }

    .barreSaisie{
        margin-top: 13px;
        margin-bottom: 6px;
        border: 2px solid grey;
        align-self: center;
        border-radius: 2px;
        text-align: center;
        width: 200px;

    }










</style>

