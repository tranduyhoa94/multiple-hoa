import Vue from 'vue'
import Router from 'vue-router'
import VueScrollTo from 'vue-scrollto'

/**
 * Participant Components
 */
import Participant from '../components/participants/Participant'
import LandingPage from '../components/participants/pages/LandingPage'
import Login from '../components/participants/pages/Login'
import ApplyNow from '../components/participants/pages/ApplyNow'
import Home from '../components/participants/pages/Home'
import SelectRole from '../components/participants/pages/SelectRole'
import Application from '../components/participants/pages/applications/Application'
import ApplicationEnrolment from '../components/participants/pages/applications/ApplicationEnrolment'
import ApplicationOverview from '../components/participants/pages/applications/ApplicationOverview'
import ApplicationOverviewMatcher from '../components/participants/pages/applications/ApplicationOverviewMatcher'
import ApplicationEdit from '../components/participants/pages/applications/ApplicationEdit'
import ApplicationEditStep from '../components/participants/pages/applications/ApplicationEditStep'
import ForgotPassword from '../components/participants/pages/ForgotPassword'
import ResetPassword from '../components/participants/pages/ResetPassword'
import ChampionRegister from '../components/participants/pages/ChampionRegister'
import Settings from '../components/participants/pages/Settings'
import Help from '../components/participants/pages/Help'
import Resources from '../components/participants/pages/Resources'
import Trainings from '../components/participants/pages/Trainings'
import CompanyPortal from '../components/participants/pages/CompanyPortal'
import MatchDetails from '../components/participants/pages/MatchDetails'
import Surveys from '../components/participants/pages/Surveys'
import SurveyComplete from '../components/participants/pages/SurveyComplete'
import Communication from '../components/participants/pages/communications/Communication'
import NewMessage from '../components/participants/pages/communications/NewMessage'
import Messages from '../components/participants/pages/communications/Messages'
import SocialRedirect from '../components/participants/pages/SocialRedirect'
import SocialApplyNow from '../components/participants/pages/SocialApplyNow'
import Notifications from '../components/participants/pages/Notifications'
import Tutorials from '../components/participants/pages/Tutorials'
import Terms from '../components/participants/pages/Terms'
import FAQ from '../components/participants/pages/FAQ'
import CompleteProfile from '../components/participants/pages/applications/CompleteProfile'
import ContactProgramManager from '../components/participants/pages/ContactProgramManager'
import CreateRole from '../components/participants/pages/CreateRole'
import ConfirmChangeRole from '../components/participants/pages/ConfirmChangeRole'
import ProgramParticipants from '../components/participants/pages/ProgramParticipants'

/**
 * Champion Components
 */
import Champion from '../components/champions/Champion'
import ChampionPreview from '../components/champions/pages/ChampionPreview'

/**
 * Error
 */
import Error404 from '../components/errors/404'
import ParticipantError from '../components/participants/pages/Error'

import participantAuth from '../auth/participant-auth'

Vue.use(Router)

var routers = [];

if(potal_access == 'PARTICIPANT'){
    routers = [
        {
            path: '/',
            name: 'participant',
            component: Participant,
            children: [
                {
                    path: '',
                    name: 'landing-page',
                    component: LandingPage
                },
                {
                    path: 'login',
                    name: 'login',
                    component: Login,
                },
                {
                    path: 'apply-now',
                    name: 'apply-now',
                    component: ApplyNow
                },
                {
                    path: 'social-redirect',
                    name: 'social-redirect',
                    component: SocialRedirect
                },
                {
                    path: 'apply-now/social',
                    name: 'social-apply-now',
                    component: SocialApplyNow
                },
                {
                    path: 'forgot-password',
                    name: 'forgot-password',
                    component: ForgotPassword
                },
                {
                    path: 'reset-password/:token',
                    name: 'reset-password',
                    component: ResetPassword
                },
                {
                    path: 'champion-register/:token',
                    name: 'champion-register',
                    component: ChampionRegister
                },
                {
                    path: 'home',
                    name: 'home',
                    component: Home
                },
                {
                    path: 'select-role',
                    name: 'select-role',
                    component: SelectRole
                },
                {
                    path: 'setting-profile/:component',
                    name: 'setting-profile',
                    component: Settings
                },
                {
                    path: 'help',
                    name: 'help',
                    component: Help
                },
                {
                    path: 'resources',
                    name: 'resources',
                    component: Resources
                },
                {
                    path: 'application',
                    name: 'application',
                    component: Application,
                    children: [
                        {
                            path: 'overview/:role',
                            name: 'application-overview',
                            component: ApplicationOverview
                        },
                        {
                            path: 'overview/matcher/:partId/:role',
                            name: 'application-overview-matcher',
                            component: ApplicationOverviewMatcher
                        },
                        {
                            path: 'enrolment',
                            name: 'application-enrolment',
                            component: ApplicationEnrolment
                        },
                        {
                            path: 'edit/:questionId/:role/:position',
                            name: 'application-edit',
                            component: ApplicationEdit
                        },
                        {
                            path: 'edit/:role/step',
                            name: 'application-edit-step',
                            component: ApplicationEditStep
                        }
                    ]
                },
                {
                    path: 'trainings',
                    name: 'trainings',
                    component: Trainings
                },
                {
                    path: 'company-portal',
                    name: 'company-portal',
                    component: CompanyPortal
                },
                {
                    path: 'match-details',
                    name: 'match-details',
                    component: MatchDetails
                },
                {
                    path: 'surveys',
                    name: 'surveys',
                    component: Surveys
                },
                {
                    path: 'surveys/complete/:programId/:programSurveyId/:programMatchId',
                    name: 'survey-complete',
                    component: SurveyComplete
                },
                {
                    path: 'communication',
                    name: 'communication',
                    component: Communication,
                    children: [
                        {
                            path: 'new-message',
                            name: 'new-message',
                            component: NewMessage
                        },
                        {
                            path: 'messages',
                            name: 'messages',
                            component: Messages
                        }
                    ]
                },
                {
                    path: 'notifications',
                    name: 'notifications',
                    component: Notifications
                },
                {
                    path: 'tutorial',
                    name: 'tutorial',
                    component: Tutorials
                },
                {
                    path: 'terms',
                    name: 'terms',
                    component: Terms
                },
                {
                    path: 'faq',
                    name: 'faq',
                    component: FAQ
                },
                {
                    path: 'complete-profile/:role',
                    name: 'complete-profile',
                    component: CompleteProfile
                },
                {
                    path: 'contact-program-manager',
                    name: 'contact-program-manager',
                    component: ContactProgramManager
                },
                {
                    path: 'create-role',
                    name: 'create-role',
                    component: CreateRole
                },
                {
                    path: 'confirm-change-role/:token',
                    name: 'confirm-change-role',
                    component: ConfirmChangeRole
                },
                {
                    path: 'program-participants',
                    name: 'program-participants',
                    component: ProgramParticipants
                },
            ]
        },
        {
            path: '/participant-error',
            name: 'participant-error',
            component: ParticipantError
        },
        {
            path: '*',
            name: 'global-error-404',
            component: Error404
        }
    ];

}else if(potal_access == 'CHAMPION'){
    routers = [
        {
            path: '/',
            name: 'champion',
            component: Champion,
            children: [
                {
                    path: 'champion-preview',
                    name: 'champion-preview',
                    component: ChampionPreview
                }
            ]
        }
    ];
}else{
    routers = [

    ];
}

var router = new Router({
    mode: 'history',
    routes: routers,
});

router.beforeEach((to, from, next) => {

    if (potal_access == 'PARTICIPANT') {
        // check program data exist
        if (!program) {
            window.location.reload()
            return;
        }

        var publicPaths = ['landing-page', 'login', 'apply-now', 'forgot-password', 'reset-password', 'social-apply-now', 'social-redirect', 'contact-program-manager', 'create-role', 'confirm-change-role', 'champion-register'];
        var vipPaths = ['help', 'global-error-404', 'participant-error', 'terms', 'faq'];

        if(vipPaths.indexOf(to.name) > -1){
            next()
            return;
        }

        // get access token in cross storage
        if(program && program.id_client){
            crossStorageClient.onConnect().then(() => {
                return crossStorageClient.get('access_token_' + program.id_client)
            }).then(access_token => {

                if(participantAuth.isAuthenticated() || access_token){
                    // reset access token
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + access_token
                    localStorage.setItem('access_token', access_token)

                    if (publicPaths.indexOf(to.name) > -1) {

                        next('/home')
                        return;
                    }

                } else {
                    if (publicPaths.indexOf(to.name) < 0) {
                        var exceptPaths = ['application-enrolment', 'select-role', 'complete-profile', 'application-edit-step'];

                        if(exceptPaths.indexOf(to.name) < 0){
                            localStorage.setItem('auth_route_after_login', to.path)
                        }

                        next('/login')
                        return;
                    }
                }

                // scroll to top when change page
                if (!(to.name == 'match-details' && to.params.matchId)) {
                    VueScrollTo.scrollTo('body', 500, {
                        easing: 'ease-in'
                    })
                }

                next();

            }).catch(error => {
                console.log(error);
                next();
            });

            return;
        }
    }

    next();
});

export default router;
