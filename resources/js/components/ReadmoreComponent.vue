<style>
button{
    border: none;
    background: white;
    color: #808080;
}
</style>
<template>    
    <div>   
        <span v-if="!readMoreActivated">{{ text.slice(0, 135)}}   </span>    
            <button v-if="!readMoreActivated" @click="activateReadMore"> ...続きを読む></button>        
        <span v-if="readMoreActivated" v-html="text"></span>
    </div>
</template>

<script>
export default {    
    props: {
        text: String
    },
    data(){        
        return {
            readMoreActivated: false
        }
    },
    methods: {    
        activateReadMore(){        
            this.readMoreActivated = true;    
        },
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>