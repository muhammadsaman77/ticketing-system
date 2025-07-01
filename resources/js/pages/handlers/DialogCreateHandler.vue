<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Form, FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage } from '@/components/ui/form';
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
</script>

<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button> Add Handler </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <Form>
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
                            <FormLabel><Em></Em>mail</FormLabel>
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
                    <FormField v-slot="{ componentField }" name="specialization">
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
            </Form>
        </DialogContent>
    </Dialog>
</template>
