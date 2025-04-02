<template>
    <transition name="dialog">
      <div v-if="dialog.state.active" class="dialog">
        <div class="dialog-inner rounded shadow">
          <h3 v-if="dialog.state.title" class="text-xl mb-2">
            {{ dialog.state.title }}
            <hr />
          </h3>
  
          <p v-if="dialog.state.html" v-html="dialog.state.message"></p>
          <p v-else>{{ dialog.state.message }}</p>
  
          <div class="my-4">
            <input
              v-if="dialog.state.type === 'prompt'"
              v-model="userInput"
              class="border-2 block w-full"
              :type="dialog.state.inputType"
              @keypress.enter="dialog.ok(userInput)"
            />
          </div>
  
          <div class="flex justify-end mt-2">
            <dk-button
              v-if="dialog.state.type !== 'alert'"
              class="bg-blue-300 text-gray-900 mr-30 p-1 rounded-sm hover:bg-blue-400 cursor-pointer"
              @click="dialog.cancel()"
            >
              {{ dialog.state.cancelText }}
            </dk-button>
            <dk-button 
              class="bg-red-300 p-1 mr-20 rounded-sm hover:bg-red-400 cursor-pointer"
              @click="dialog.ok(userInput)">{{
              dialog.state.okText
            }}</dk-button>
          </div>
        </div>
        <div class="dialog-bg" @click="dialog.cancel()"></div>
      </div>
    </transition>
  </template>
  
  <script>
  import { useDialog } from '../assets/utils/dialog.js'

  export default {
    name:"dialogBox",
    setup(){
      const dialog = useDialog();
      return { dialog };
    },
    data() {
      return {
        userInput: '',
      }
    },
  }
  </script>
  
  <style>
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
  .dialog-inner {
    will-change: contents;
    transform-origin: center;
    transition: all 0.3s ease-out;
    background: white;
    z-index: 2;
    padding: 20px;
    position: fixed;
    top: 200px;
    left: 50%;
    transform: translateX(-50%);
    min-width: 400px;
    opacity: 1;
  }
  </style>
  