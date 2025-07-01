<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Submissions',
        href: '/submissions',
    },
];
</script>
<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <Table>
                <TableHeader>
                    <TableHead>#</TableHead>
                    <TableHead>Submitter</TableHead>
                    <TableHead>title</TableHead>
                    <TableHead>Description</TableHead>
                    <TableHead>Handler</TableHead>
                    <TableHead>Status</TableHead>
                    <TableHead>Action</TableHead>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="index in 5">
                        <TableHead>{{ index + 1 }}</TableHead>
                        <TableCell>{{}}</TableCell>
                        <TableCell>{{}}</TableCell>
                        <TableCell>{{}}</TableCell>
                        <TableCell>{{}}</TableCell>
                        <TableCell>{{}}</TableCell>
                        <TableCell class="space-x-2">
                            <Button>Edit</Button>
                            <Button variant="destructive">Delete</Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
