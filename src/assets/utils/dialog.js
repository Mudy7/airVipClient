import { reactive } from 'vue'

const state = reactive({
    type: 'confirm',
    active: false,
    message: '',
    title: '',
    okText: 'Ok',
    cancelText: 'Cancel',
    inputType: 'text',
    html: false,
})

let close;
const dialogPromise = () => new Promise((resolve, reject) => close = resolve);

const open = (message) => {
    state.message = message
    state.active = true
    return dialogPromise()
}

const reset = () => {
    state.active = false
    state.message = ''
    state.title = ''
    state.okText = 'Ok'
    state.cancelText = 'Cancel'
    state.inputType = 'text'
    state.html = false
}

const dialog = {
    get state(){
        return state
    },
    alert(message){
        state.type = 'alert'
        return open(message)
    },
    confirm(message){
        state.type = 'confirm'
        return open(message)
    },
    prompt(message){
        state.type = 'prompt'
        return open(message)
    },
    cancel(){
        close(false)
        reset()
    },
    ok(input=true){
        input = state.type === 'prompt' ? input: true
        close(input)
        reset()
    },
    title(title){
        state.title = title
        return this
    },
    okText(text){
        state.okText = text
        return this
    },
        
    cancelText(text){
        state.cancelText = text
        return this
    },
    inputType(type){
        state.inputType = type
        return this
    },
    html(enabled = true){
        state.html = enabled
        return this
    }
}

export function useDialog() {
    return dialog;
}

export default dialog