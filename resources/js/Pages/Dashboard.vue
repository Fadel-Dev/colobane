<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';



const  props = defineProps({
    topics:Array
    });
</script>

<template>
    <AppLayout title="Dashboard">
        <template>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
  <div class="bg-white text-slate-900">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-4 lg:max-w-7xl lg:px-8">
      <h2 class="text-2xl font-bold tracking-tight text-gray-900"> {{ $page.props.auth.user.name}} Vos Publications  </h2>

      <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        <div v-for="topic in topics" :key="topic.id" class="group relative">
          <div class="min-h-80 aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
            <img :src="topic.image1" :alt="topic.imageAlt" class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
          </div>
          <div class="mt-4 flex justify-between">
            <div>
              <h3 class="text-sm text-gray-700">
                <a :href="topic.href">
                  <span aria-hidden="true" class="absolute inset-0 uppercase   " />
                  {{ topic.name }}
                </a>
              </h3>
              <p class="mt-1 text-sm text-gray-500">{{ topic.color }}</p>
            </div>
            <p class="text-sm font-medium text-gray-900">{{ topic.prix }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

    </AppLayout>
</template>
