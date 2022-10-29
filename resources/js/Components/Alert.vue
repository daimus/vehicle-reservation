<script setup>

</script>

<template>
    <div v-if="$page.props.flash.message" class="mb-4 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
        {{ $page.props.flash.message }}
    </div>
    <div v-if="$page.props.flash.error" class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
        {{ $page.props.flash.error }}
    </div>
</template>
