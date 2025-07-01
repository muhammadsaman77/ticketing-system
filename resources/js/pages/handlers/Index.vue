<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import DialogCreateHandler from '@/pages/handlers/DialogCreateHandler.vue';
import { BreadcrumbItem } from '@/types';
import { usePage } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Handlers',
        href: '/handlers',
    },
];
type Handler = {
    id: number;
    name: string;
    email: string;
    phone_number: string;
    specialization: string;
    role: string;
};
const page = usePage();
const handlers = page.props.handlers as Handler[];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <DialogCreateHandler />
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
                    <TableRow v-for="(item, index) in handlers">
                        <TableHead>{{ index + 1 }}</TableHead>
                        <TableCell>{{ item.name }}</TableCell>
                        <TableCell>{{ item.email }}</TableCell>
                        <TableCell>{{ item.phone_number }}</TableCell>
                        <TableCell>{{ item.specialization }}</TableCell>
                        <TableCell>{{ item.role }}</TableCell>
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
