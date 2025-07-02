<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage } from '@/components/ui/form';
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { phoneNumberValidation } from '@/lib/custom_validation';
import { router, usePage } from '@inertiajs/vue3';
import { toTypedSchema } from '@vee-validate/zod';
import { useForm } from 'vee-validate';
import { computed } from 'vue';
import { toast } from 'vue-sonner';
import * as z from 'zod';
type FormData = {
    name: string;
    email: string;
    phone_number: string;
    specialization: string;
    role: string;
};

const page = usePage();
const errors = computed(() => page.props.errors || {});

const { handleSubmit } = useForm<FormData>({
    validationSchema: toTypedSchema(
        z.object({
            name: z.string().max(255),
            email: z.string().email(),
            phone_number: z.string().max(20).regex(phoneNumberValidation, 'Invalid phone number'),
            specialization: z.string().max(50),
            role: z.enum(['PIC', 'HELPDESK']),
        }),
    ),
});

const onSubmit = handleSubmit((values) => {
    router.post(route('handlers.store'), values, {
        onSuccess: (v) => {
            router.visit(route('handlers.index'), {
                onSuccess: () => {
                    toast.success(v.props.flash.success ?? '');
                },
            });
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
                            <template v-if="errors?.name">
                                <span class="text-sm text-destructive"> {{ errors.email }} </span>
                            </template>
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
                            <template v-if="errors?.email">
                                <span class="text-sm text-destructive"> {{ errors.email }} </span>
                            </template>
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
                            <template v-if="errors?.phone_number">
                                <span class="text-sm text-destructive"> {{ errors.email }} </span>
                            </template>
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
                            <template v-if="errors?.specialization">
                                <span class="text-sm text-destructive"> {{ errors.email }} </span>
                            </template>
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
                            <template v-if="errors?.role">
                                <span class="text-sm text-destructive"> {{ errors.email }} </span>
                            </template>
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
