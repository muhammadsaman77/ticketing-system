<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Handlers',
        href: '/handlers',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <Table>
                <TableHeader>
                    <TableHead>#</TableHead>
                    <TableHead>Name</TableHead>
                    <TableHead>Email</TableHead>
                    <TableHead>Phone Number</TableHead>
                    <TableHead>Specialization</TableHead>
                    <TableHead>Role</TableHead>
                    <TableHead>Action</TableHead>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="n in 5" :key="n">
                        <TableHead>{{ n }}</TableHead>
                        <TableCell>John Doe</TableCell>
                        <TableCell>oH5dO@example.com</TableCell>
                        <TableCell>1234567890</TableCell>
                        <TableCell>Network Engineer</TableCell>
                        <TableCell>PIC</TableCell>
                        <TableCell class="space-x-2">
                            <Button>Edit</Button>
                            <Button variant="destructive">Delete</Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div></AppLayout
    >
</template>
