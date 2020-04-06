<template>
  <div class="flex items-center">
    <div class="md:w-1/2 md:mx-auto">
      <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
        <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">Example Component</div>

        <div class="w-full p-6">
          <p class="text-gray-700">I'm an example component.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
