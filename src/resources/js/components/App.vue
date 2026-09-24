<template>
  <div class="container mt-5 text-center">
    <h1 class="text-primary">{{ message }}</h1>
    <p>Vue 3 Composition API setup test</p>
    
    <button @click="increment" class="btn btn-success">
      Count: {{ count }}
    </button>
    <button @click="showOwn" class="btn btn-success">
        Change msg
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue';

// State Variable
const message = ref('Hello World from Abdul!');
const count = ref(0);

// Function
function increment() {
  count.value++;
}
function showOwn()
{
    message.value= 'Aapka naya message yahan aagaya!';
}
</script>

<style scoped>
h1 {
  font-weight: bold;
}
</style>