<script setup lang="ts">
  import AppLayout from '@/layouts/AppLayout.vue';
  import { dashboard2 } from '@/routes';
  import type { BreadcrumbItem } from '@/types';
  import { Head } from '@inertiajs/vue3'
  import PlaceholderPattern from '../components/PlaceholderPattern.vue';

  const breadcrumbs: BreadcrumbItem[] = [
      {
          title: 'Dashboard2',
          href: dashboard2().url,
      },
  ];

  // defineProps<{}>()
</script>

<template>
    <Head title="Dashboard2" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <!--<div-->
                <!--    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">-->
                <!--    <PlaceholderPattern />-->
                <!--    jetzt samma auf dem dashboard2-->
                <!--</div>-->
            </div>
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <PlaceholderPattern />
                jetzt samma auf dem dashboard2
            </div>
        </div>
    </AppLayout>
</template>
