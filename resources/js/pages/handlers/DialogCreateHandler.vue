<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage } from '@/components/ui/form';
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { phoneNumberValidation } from '@/lib/custom_validation';
import { router } from '@inertiajs/vue3';
import { toTypedSchema } from '@vee-validate/zod';
import { useForm } from 'vee-validate';
import * as z from 'zod';
type FormData = {
    name: string;
    email: string;
    phone_number: string;
    specialization: string;
    role: string;
};

const { handleSubmit } = useForm<FormData>({
    validationSchema: toTypedSchema(
        z.object({
            name: z.string(),
            email: z.string().email(),
            phone_number: z.string().regex(phoneNumberValidation, 'Invalid phone number'),
            specialization: z.string(),
            role: z.enum(['PIC', 'HELPDESK']),
        }),
    ),
});

const onSubmit = handleSubmit((values) => {
    router.post(route('handlers.store'), values, {
        onSuccess: () => {
            router.visit(route('handlers.index'));
        },
        onError: (e) => {
            router.visit(route('handlers.index'));
        },
    });
});
</script>

<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button> Add Handler </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <form @submit="onSubmit">
                <DialogHeader>
                    <DialogTitle>Add Handler</DialogTitle>
                    <DialogDescription> Add a new handler. Click submit when you're done. </DialogDescription>
                </DialogHeader>
                <div class="mt-4 space-y-4">
                    <FormField v-slot="{ componentField }" name="name">
                        <FormItem>
                            <FormLabel>Name</FormLabel>
                            <FormControl>
                                <Input type="text" placeholder="John Doe" v-bind="componentField" />
                            </FormControl>
                            <FormDescription> This is handler public display name. </FormDescription>
                            <FormMessage />
                        </FormItem>
                    </FormField>
                    <FormField v-slot="{ componentField }" name="email">
                        <FormItem>
                            <FormLabel>Email</FormLabel>
                            <FormControl>
                                <Input type="text" placeholder="email@example.com" v-bind="componentField" />
                            </FormControl>
                            <FormDescription> This is handler email. </FormDescription>
                            <FormMessage />
                        </FormItem>
                    </FormField>
                    <FormField v-slot="{ componentField }" name="phone_number">
                        <FormItem>
                            <FormLabel>Phone Number</FormLabel>
                            <FormControl>
                                <Input type="text" placeholder="+1 (555) 555-5555" v-bind="componentField" />
                            </FormControl>
                            <FormDescription> This is handler phone number. </FormDescription>
                            <FormMessage />
                        </FormItem>
                    </FormField>
                    <FormField v-slot="{ componentField }" name="specialization">
                        <FormItem>
                            <FormLabel>Specialization</FormLabel>
                            <FormControl>
                                <Input type="text" placeholder="Network Engineer" v-bind="componentField" />
                            </FormControl>
                            <FormDescription> This is handler specialization. </FormDescription>
                            <FormMessage />
                        </FormItem>
                    </FormField>
                    <FormField v-slot="{ componentField }" name="role">
                        <FormItem>
                            <FormLabel>Role</FormLabel>
                            <Select v-bind="componentField">
                                <FormControl>
                                    <SelectTrigger class="w-full">
                                        <SelectValue placeholder="Select a role to handler" />
                                    </SelectTrigger>
                                </FormControl>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectItem value="PIC"> PIC </SelectItem>
                                        <SelectItem value="HELPDESK"> HELPDESK </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <FormDescription> This is handler role. </FormDescription>
                            <FormMessage />
                        </FormItem>
                    </FormField>
                </div>
                <DialogFooter>
                    <Button type="submit"> Submit</Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>
