import {createRouter, createWebHistory} from 'vue-router';
import HomePage from "./pages/HomePage.vue";
import JobListingsPage from "./pages/JobListingsPage.vue";
import Dashboard from "./pages/Dashboard.vue";
import NotFoundPage from "./pages/NotFoundPage.vue";
import Employers from "./pages/Employers.vue";
import Summary from "./components/dashboard/employer/company/CompanySummary.vue";
import SummaryForm from "./components/dashboard/employer/company/SummaryForm.vue";
import ChangePassword from "./components/dashboard/employer/settings/ChangePassword.vue";

const routes = [
    {path: '/', component: HomePage},
    {path: '/vakances', component: JobListingsPage},
    {path: '/darba-devejiem', component: Employers},
    {
        path: '/vadibas-panelis', component: Dashboard, children: [
            {path: '', component: Summary},
            {path: 'uznemuma-informacija', component: SummaryForm},
            {
                path: 'iestatijumi', children: [
                    {path: 'mainit-paroli', component: ChangePassword}
                ]
            }
            // {
            //     path: 'vakances', component: JobListings, children: [
            //         {path: '', component: AllListings},
            //         {path: 'aktivas', component: ActiveListings},
            //         {path: 'vesture', component: ListingHistory},
            //         {path: 'iestatijumi', component: ListingSettings},
            //         {path: ':id', component: SingleListing},
            //         {path: ':id/labot', component: UpdateListing},
            //         {path: 'pievienot', component: CreateListing}
            //     ]
            // },
            // {
            //     path: 'uznemums', component: CompanyInfo, children: [
            //         {path: 'informacija', component: CompanyInfoForm},
            //         {path: '', component: CompanyInfoPanel},
            //     ]
            // }
        ]
    },
    {path: '/:pathMatch(.*)*', component: NotFoundPage},
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;
