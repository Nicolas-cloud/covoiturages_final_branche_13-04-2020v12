<?php

namespace App\Security;

use App\Entity\Reservation;
use App\Entity\Trajet;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;


/**
 * It grants or denies permissions for actions related to trajet (such as
 * showing, editing and deleting posts).
 *
 * See https://symfony.com/doc/current/security/voters.html
 *
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class ReservationVoter extends Voter
{
    // Defining these constants is overkill for this simple application, but for real
    // applications, it's a recommended practice to avoid relying on "magic strings"
    public const RESERVE = 'reserver';

    /**
     * {@inheritdoc}
     */
    protected function supports($attribute, $subject): bool
    {
        // this voter is only executed for three specific permissions on Trajet objects
        return $subject instanceof Reservation && \in_array($attribute, [self::CREATE, self::EDIT, self::DELETE], true);
    }

    /**
     * {@inheritdoc}
     */
    protected function voteOnAttribute($attribute, $reservation, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // the user must be logged in; if not, deny permission
        if (!$user instanceof User) {
            return false;
        }

        // the logic of this voter is pretty simple: if the logged user is the
        // author of the given trajet, grant permission; otherwise, deny it.
        // (the supports() method guarantees that $trajet is a Trajet object)
        return $user === $reservation->getPassager();
    }

}