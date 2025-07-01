<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { usePage } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Submissions',
        href: '/submissions',
    },
];
type Tickets = {
    id: number;

    title: string;
    description: string;
    submitter: {
        name: string;
        email: string;
    };
    handler: {
        name: string;
        email: string;
    };
    status: string;
};
const page = usePage();
const tickets = page.props.tickets as Tickets[];
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
                    <TableRow v-for="(item, index) in tickets">
                        <TableHead>{{ index + 1 }}</TableHead>
                        <TableCell>{{ item.submitter.name }}</TableCell>
                        <TableCell>{{ item.title }}</TableCell>
                        <TableCell class="whitespace-normal">{{ item.description }}</TableCell>
                        <TableCell>{{}}</TableCell>
                        <TableCell>{{ item.status }}</TableCell>
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
