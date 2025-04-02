<template>

    <div class="boxAj">

        <div class = "enteteAj">
            Ajouter de l'aéroport
        </div>

        <div class="boxModifierAj">

            
                <div class="titreSaisieAj">
                    Code IATA
                </div>
                <div class="boxsaisieAj">
                    <input class = "barreSaisieAj" type="text" placeholder="Entrez votre texte ici" id="AA_iata">

                </div>
       
        </div>

        <div class="boxModifierAj">

                <div class="titreSaisieAj">
                    Ville
                </div>

                <div class="boxsaisieAj">
                    <input class = "barreSaisieAj" type="text" placeholder="Entrez votre texte ici" id="AA_ville">

                </div>
           
        </div>

        <div class="boxModifierAj">
            
            
                <div class="titreSaisieAj">
                    Pays
                </div>
                
                <div class="boxsaisieAj">
                    <input class = "barreSaisieAj" type="text" placeholder="Entrez votre texte ici" id="AA_pays">

                </div>
            
        </div>

        <div class="boxModifierAj">

            <div class="titreSaisieAj">
                    Distance de Montréal
                </div>
                
                <div class="boxsaisieAj">
                    <input class = "barreSaisieAj" type="text" placeholder="Entrez votre texte ici" id="AA_distance">

                </div>
        </div>

        <div>
            <button class="boutonConfirmerAj">Confirmer</button>
        </div>

        <button @click="ajouter">Valider</button>
        <button @click="$emit('fermer')">Annuler</button>

    </div>

</template>

<script>
export default {
    name:"ajouterAero"
  }
</script>



<style>
    .boxAj {
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

    .enteteAj{
        
        /*margin-bottom: 4px;*/
        text-align: center;
        width: 100%;
        border-bottom: 3px solid grey;
        font-size: 20px;
        font-weight: bold;
        background-color: rgb(96, 243, 96);
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









</style>

