<?php

namespace Management\AdminBundle\Controller;

use DateTime;
use Management\AdminBundle\Entity\User;
use Management\AdminBundle\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\HttpFoundation\Request;

/**
 * RegistrationController
 *
 * @Route("/")
 * @package Management\AdminBundle\Controller
 */
class RegistrationController extends Controller {
    /**
     * @Route("/register", name="register")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registrationAction(Request $request) {
        /**
         * Create a new blank user and process the form
         */
        $user = new User();
        $user->setExperience(0);

        $form = $this->createForm(RegistrationType::class, $user);

        if ($request->get('response')) {
//            $plainPasswordOptions = $form->get('plainPassword')->getConfig()->getOptions();
//            $plainPasswordOptions['required'] = false;
//            $form->add('plainPassword', RepeatedType::class, $plainPasswordOptions);

            $response = $request->get('response');
//            $form->get('fullName')->setData($response['full_name']);
            $form->get('email')->setData($response['email']);
            $form->get('firstName')->setData($response['first_name']);
            $form->get('lastName')->setData($response['last_name']);
//            $form->get('username')->setData($response['username']);
            $form->get('sex')->setData($response['sex']);
            $form->get('dateOfBirth')->setData(
                DateTime::createFromFormat($response['date_of_birth_format'], $response['date_of_birth'])->setTime(0, 0, 0));
            $form->get('phoneNumber1')->setData($response['phone_number']);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * Encode the new user's password
             */
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            /**
             * Clear plain password
             */
            $user->setPlainPassword(NULL);

            /**
             * Set salt using safety random_bytes() method
             */
            $user->setSalt($this->getToken(32));
//            var_dump(random_bytes(32));

            /**
             * Set user as active
             */
            $user->setIsActive(FALSE);

            /**
             * Set his / her role
             */
            //$user->setRoles(['ROLE_USER']);

            /**
             * Set date of birth
             */

            /**
             * Set social IDs
             */
            if ($request->get('response')) {
                if ($request->get('response')['social_network'] === 'vkontakte') {
                    $user->setVkId($request->get('response')['uid']);
                }
                elseif ($request->get('response')['social_network'] === 'odnoklassniki') {
                    $user->setOkId($request->get('response')['uid']);
                }
            }

            /**
             * Set date of creation and assume that this user just has also been changed
             */
            $dateOfCreation = new \DateTime('NOW');
            $user->setDateOfCreation($dateOfCreation);
            $user->setDateOfChange($dateOfCreation);

            /**
             * Save
             */
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->sendConfirmation($user);

            return $this->render('@ManagementAdmin/register/after_registration.html.twig', [
                'user' => $user
            ]);
        }

        return $this->render('@ManagementAdmin/register/register.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/resend_confirmation/{id}", name="resend_confirmation")
     *
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resendConfirmationAction(Request $request, User $user) {
        $this->sendConfirmation($user);

        return $this->render('@ManagementAdmin/register/after_registration.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * Send confirmation to the user's E-Mail address
     *
     * @param User $user
     */
    public function sendConfirmation(User $user) {
        $email = $user->getEmail();
        /**
         * Generate salt_hash using Blowfish algorithm and random salt
         */
//            $email_hash = md5(password_hash(
//                $email,                                         // E-Mail as a hash object
//                PASSWORD_BCRYPT,                                // using Blowfish algorithm
//                ['cost' => 12, 'salt' => random_bytes(22)]));   // salt for user's salt
        $token = md5(md5($email . $user->getId()) . $user->getPassword());

        $uri = 'http://tennison.dev.scada.lv/register/' . $user->getId() . '/validate?token=' . $token;
//        $uri = 'http://localhost:8001/register/' . $user->getId() . '/validate?token=' . $token;

        $mailer = $this->get('mailer');

        $message = $mailer->createMessage()
            ->setSubject('Welcome to Tennison!')
            ->setFrom('tennison_dev@axeta.ru')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    '@ManagementAdmin/register/email_confirmation.html.twig', [
                    'uri' => $uri
                ]),
                'text/html'
            );

        $mailer->send($message);
    }

    /**
     * @Route("/register/{id}/validate", name="validate_registration")
     * @Method("GET")
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function validateRegistrationAction(Request $request, $id) {
        if ($request->get('token')) {
            $token = $request->query->get('token');

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('ManagementAdminBundle:User')->find($id);

            if (md5(md5($user->getEmail() . $user->getId()) . $user->getPassword()) ==
                $request->query->get('token')) {
                $user->setIsActive(TRUE);

                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('login');
            }
        }
    }

    /**
     * @Route("/terms", name="register_terms")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showTermsAction(Request $request) {
        return $this->render('@ManagementAdmin/register/register_terms.html.twig');
    }

    function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    function getToken($length) {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }
}