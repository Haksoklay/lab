<script setup>
import { computed } from 'vue';

    const props =defineProps(['text','size']);
    // const textSize =computed(()=>{

    // })

    const number =ref(0)
    const doubleNumber=computed(()=>{
        return number.value*2
    });


</script>

<template>
    {{ doubleNumber }}
    <button @click="number++">Increment{{ number }}</button>

    <h1 class="text-3xl">
        {{ text }}
    </h1>

</template>