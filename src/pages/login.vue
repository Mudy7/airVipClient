<template>
  <div class="flex flex-row h-screen">
    <div
      class="absolute top-5 left-5 cursor-pointer"
      @click="$router.push('/')"
    >
      <img class="h-6 w-auto" src="/assets/icons/logo.png" alt="Logo" />
    </div>
    <section
      class="flex flex-1 lg:w-[60%] flex-col items-center justify-center px-12"
    >
      <div class="absolute top-10"></div>
      <div class="w-full max-w-[24rem]">
        <div class="text-center">
          <span class="text-[28px]">Bienvenue</span>
        </div>
        <div class="pt-1 text-center">
          <span class="text-md text-gray-400"
            >Veuillez entrer vos informations</span
          >
        </div>
        <div v-if="passwordError2" class="pt-1 text-center">
          <span class="text-sm text-red-400">
            Votre adresse courriel ou mot de passe est incorrect
          </span>
        </div>
        <div class="pt-4">
          <div
            class="relative flex rounded-lg py-1 px-1 bg-white shadow-sm h-12"
          >
            <div
              class="absolute top-0 left-0 h-full w-1/2 bg-[#f1f2f2] transition-all duration-400"
              :class="{ 'translate-x-full': selected_option === 'S\'inscrire' }"
            ></div>
            <button
              v-for="option in ['Se connecter', 'S\'inscrire']"
              :key="option"
              class="relative outline-none flex-1 justify-center items-center z-10"
              @click="handleButtonClick(option)"
            >
              <span
                class="flex w-full h-full hover:text-gray-200 rounded-lg justify-center items-center"
                :style="{
                  color: selected_option === option ? 'black' : 'gray',
                }"
              >
                {{ option }}
              </span>
            </button>
          </div>
        </div>
        <div v-if="selected_option === 'Se connecter'">
          <div class="pt-8 flex flex-col w-full">
            <label class="text-start pb-2 text-sm">Adresse Couriel</label>
            <input
              v-model="email"
              placeholder="entrer votre adresse couriel"
              name="email"
              type="email"
              class="outline-none w-full rounded-md border-0 py-3 px-5 bg-[#ffffff] text-gray-900 shadow-sm ring-1 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary"
              :class="{
                'ring-red-400': emailError,
                'ring-gray-300': !emailError,
              }"
            />
            <span class="pt-1 text-[12px] text-red" v-if="emailError">
              {{ emailErrorText }}</span
            >
          </div>
          <div class="pt-5 flex flex-col w-full">
            <label class="text-start pb-2 text-sm">Mot de passe</label>
            <input
              v-model="password"
              placeholder="mot de passe"
              name="password"
              type="password"
              class="outline-none w-full rounded-md border-0 py-3 px-5 bg-[#ffffff] text-gray-900 shadow-sm ring-1 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary"
              :class="{
                'ring-red-400': passwordError,
                'ring-gray-300': !passwordError,
              }"
            />
            <span class="pt-1 text-[12px] text-red" v-if="passwordError">
              {{ passwordErrorText }}</span
            >
          </div>
          <div class="pt-7 flex">
            <button
              class="bg-primary btn-hover cursor-pointer rounded-lg text-white p-3 w-full"
              @click="submit_connect"
            >
              Connection
            </button>
          </div>
        </div>
        <div v-else>
          <div class="pt-8 flex flex-col w-full">
            <label class="text-start pb-2 text-sm">Adresse Couriel</label>
            <input
              v-model="email"
              placeholder="entrer votre adresse couriel"
              name="email"
              type="email"
              class="outline-none w-full rounded-md border-0 py-3 px-5 bg-[#ffffff] text-gray-900 shadow-sm ring-1 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary"
              :class="{
                'ring-red-400': emailError,
                'ring-gray-300': !emailError,
              }"
            />
            <span class="pt-1 text-[12px] text-red" v-if="emailError">
              {{ emailErrorText }}</span
            >
          </div>
          
          <div class="pt-5 flex flex-col w-full">
            <label class="text-start pb-2 text-sm">Nom</label>
            <input
              v-model="name"
              placeholder="entrer votre nom"
              name="name"
              class="outline-none w-full rounded-md border-0 py-3 px-5 bg-[#ffffff] text-gray-900 shadow-sm ring-1 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary"
              :class="{
                'ring-red-400': nameError,
                'ring-gray-300': !nameError,
              }"
            />
            <span class="pt-1 text-[12px] text-red" v-if="nameError">
              {{ nameErrorText }}</span
            >
          </div>
          <div class="pt-5 flex flex-col w-full">
            <label class="text-start pb-2 text-sm">Prénom</label>
            <input
              v-model="firstName"
              placeholder="entrer votre prénom"
              name="firstName"
              class="outline-none w-full rounded-md border-0 py-3 px-5 bg-[#ffffff] text-gray-900 shadow-sm ring-1 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary"
              :class="{
                'ring-red-400': firstNameError,
                'ring-gray-300': !firstNameError,
              }"
            />
            <span class="pt-1 text-[12px] text-red" v-if="firstNameError">
              {{ firstNameErrorText }}
            </span>
          </div>

          <div class="pt-5 flex flex-col w-full">
            <label class="text-start pb-2 text-sm">Mot de passe</label>
            <input
              v-model="password"
              placeholder="mot de passe"
              name="password"
              type="password"
              class="outline-none w-full rounded-md border-0 py-3 px-5 bg-[#ffffff] text-gray-900 shadow-sm ring-1 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary"
              :class="{
                'ring-red-400': passwordError,
                'ring-gray-300': !passwordError,
              }"
            />
            <span class="pt-1 text-[12px] text-red" v-if="passwordError">
              {{ passwordErrorText }}</span
            >
          </div>
          <div v-if="signupGeneralError" class="pt-4 text-center">
            <span class="text-sm text-red-500">
              {{ signupGeneralError }}
            </span>
          </div>
          <div class="pt-7 flex">
            <button
              class="bg-primary btn-hover cursor-pointer rounded-lg text-white p-3 w-full"
              @click="submit_signup"
            >
              S'inscrire
            </button>
          </div>
        </div>
        <div v-if="accountCreated" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
          <div class="bg-white rounded-lg p-6 shadow-lg text-center max-w-sm w-full">
            <h2 class="text-xl font-semibold mb-2">Compte créé !</h2>
            <p class="text-gray-700 mb-4">Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.</p>
            <button class="bg-primary text-white px-4 py-2 rounded hover:bg-blue-600" @click="closeDialog">
              OK
            </button>
          </div>
        </div>
      </div>
    </section>

    <section class="hidden md:block lg:w-[40%] h-screen">
      <img
        class="w-full h-full object-cover"
        src="https://images.unsplash.com/photo-1616193572425-fd11332ec645?q=80&w=2127&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fHx8fA%3D%3D"
        alt=""
      />
    </section>
  </div>
</template>

<script>
  import { ref } from "vue";
  import { post } from "../assets/utils/communications.js";
  import { HTTP_STATUS_CODES } from "../assets/utils/constants.js";

  export default {
    name: "CreateAccount",
    data() {
    return {
      email: "", 
      password: "",
      selected_option: "Se connecter",
      emailError: false,
      passwordError: false,
      emailErrorText: "",
      passwordErrorText: "",
      passwordError2: false,
      firstName: "",
      firstNameError: false,
      firstNameErrorText: "",
      accountCreated: false,
      signupGeneralError: "",
    };
  },
    methods: {
      handleButtonClick(option) {
        this.selected_option = option;
      },
      async submit_connect() {
        const userData = {
          adresse_courriel: this.email,
          mot_de_passe: this.password
        };

        try {
          const { status, body } = await post("utilisateurs/sign-in", userData);

          if (status === 200) { 
            console.log("Réponse:", body);

            // Stocker le token, le role et le id de l'utilisateur dans le localStorage
            localStorage.setItem("token", body.token);
            localStorage.setItem("role", body.role); 
            localStorage.setItem("userId", body.id);

            this.$router.push("/");
          } else {
            this.passwordError2 = true;
            this.password = "";
          }
        } catch (error) {
          console.error("Erreur de connexion:", error);
        }
      },

      closeDialog() {
        this.accountCreated = false;
        this.selected_option = "Se connecter";
        this.email = "";
        this.password = "";
        this.name = "";
        this.firstName = "";
      },

      async submit_signup() {
        // Reset all error states
        this.emailError = false;
        this.firstNameError = false;
        this.nameError = false;
        this.passwordError = false;
        this.emailErrorText = "";
        this.firstNameErrorText = "";
        this.nameErrorText = "";
        this.passwordErrorText = "";
        this.signupGeneralError = "";

        // Validate fields
        if (!this.email || !this.password || !this.name || !this.firstName) {
          if (!this.email) {
            this.emailError = true;
            this.emailErrorText = "Email requis";
          }
          if (!this.firstName) {
            this.firstNameError = true;
            this.firstNameErrorText = "Prénom requis";
          }
          if (!this.name) {
            this.nameError = true;
            this.nameErrorText = "Nom requis";
          }
          if (!this.password) {
            this.passwordError = true;
            this.passwordErrorText = "Mot de passe requis";
          }
          return;
        }

        const userData = {
          adresse_courriel: this.email,
          mot_de_passe: this.password,
          nom: this.name,
          prenom: this.firstName,
          role: 'client' 
        };

        try {
          const response = await post("utilisateurs/sign-up", userData);
          if (response.status === 201) {
            this.accountCreated = true;
          } else {
            this.emailError = true;
            this.emailErrorText = "Erreur d'inscription. Réessayez.";
          }
        } catch (error) {
          console.error("Signup failed:", error.message);
          this.signupGeneralError = "Cette adresse est déjà associée à un compte ou le mot de passe est trop court (min. 8 caractères).";
        }
      },
    },
  };
</script>

<style scoped></style>
