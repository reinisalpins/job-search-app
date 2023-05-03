import {createRouter, createWebHistory} from 'vue-router';
import HomePage from "./Pages/HomePage.vue";
import JobListingsPage from "./Pages/JobListingsPage.vue";
import ProfilePage from "./Pages/ProfilePage.vue";
import NotFoundPage from "./Pages/NotFoundPage.vue";
import Employers from "./Pages/Employers.vue";
import JobListings from "./components/Profile/Employer/JobListings/JobListings.vue";
import CompanyInfo from "./components/Profile/Employer/Profile/CompanyInfo.vue";
import CompanyInfoForm from "./components/Profile/Employer/Profile/CompanyInfoForm.vue";
import CompanyInfoPanel from "./components/Profile/Employer/Profile/CompanyInfoPanel.vue";
import AllListings from "./components/Profile/Employer/JobListings/AllListings.vue";
import ActiveListings from "./components/Profile/Employer/JobListings/ActiveListings.vue";
import ListingHistory from "./components/Profile/Employer/JobListings/ListingHistory.vue";
import ListingSettings from "./components/Profile/Employer/JobListings/ListingSettings.vue";

const routes = [
    {path: '/', component: HomePage},
    {path: '/vakances', component: JobListingsPage},
    {path: '/darba-devejiem', component: Employers},
    {
        path: '/profils', component: ProfilePage, children: [
            {
                path: 'vakances', component: JobListings, children: [
                    {path: '', component: AllListings},
                    {path: 'aktivas', component: ActiveListings},
                    {path: 'vesture', component: ListingHistory},
                    {path: 'iestatijumi', component: ListingSettings},
                ]
            },
            {
                path: 'uznemums', component: CompanyInfo, children: [
                    {path: 'informacija', component: CompanyInfoForm},
                    {path: '', component: CompanyInfoPanel},
                ]
            }
        ]
    },
    {path: '/:pathMatch(.*)*', component: NotFoundPage},
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;
