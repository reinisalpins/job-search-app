import {createRouter, createWebHistory} from 'vue-router';
import HomePage from "./Pages/HomePage.vue";
import JobListingsPage from "./Pages/JobListingsPage.vue";
import ProfilePage from "./Pages/ProfilePage.vue";
import NotFoundPage from "./Pages/NotFoundPage.vue";
import Employers from "./Pages/Employers.vue";
import JobListings from "./components/Profile/Employer/Listings/JobListings.vue";
import CompanyInfo from "./components/Profile/Employer/Profile/CompanyInfo.vue";
import CompanyInfoForm from "./components/Profile/Employer/Profile/CompanyInfoForm.vue";
import CompanyInfoPanel from "./components/Profile/Employer/Profile/CompanyInfoPanel.vue";
import AllListings from "./components/Profile/Employer/Listings/ListingFilter/AllListings.vue";
import ActiveListings from "./components/Profile/Employer/Listings/ListingFilter/ActiveListings.vue";
import ListingHistory from "./components/Profile/Employer/Listings/ListingFilter/ListingHistory.vue";
import ListingSettings from "./components/Profile/Employer/Listings/ListingSettings.vue";
import SingleListing from "./components/Profile/Employer/Listings/SingleListing.vue";
import CreateListing from "./components/Profile/Employer/Listings/CreateListing/CreateListing.vue";
import UpdateListing from "./components/Profile/Employer/Listings/UpdateListing/UpdateListing.vue";

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
                    {path: ':id', component: SingleListing},
                    {path: ':id/labot', component: UpdateListing},
                    {path: 'pievienot', component: CreateListing}
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
