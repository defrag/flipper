<?php

namespace spec\Coduo\Flipper\Activation\Strategy;

use Coduo\Flipper\Feature;
use Coduo\Flipper\Identifier;
use Coduo\Tests\Flipper\TestUser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserIdentifierSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Coduo\Flipper\Activation\Strategy\UserIdentifier');
    }

    function it_is_active_for_user_by_flipper_identifier(Feature $feature)
    {
        $identifier = new Identifier('michal');
        $this->addIdentifier($identifier);
        $this->isActive($feature, $identifier)->shouldReturn(true);
    }

    function it_is_not_active_for_users_who_doesnt_belong_to_feature(Feature $feature)
    {
        $identifier = new Identifier('michal');
        $this->addIdentifier($identifier);
        $this->isActive($feature, new Identifier('claudio'))->shouldReturn(false);
    }

    function it_can_only_accept_identifiers_as_constructor_parameter()
    {
        $this->shouldThrow(new \InvalidArgumentException("Only instance of Identifier is accepted by UserIdentifier strategy"))
            ->during('__construct', array(array('fooo')));
    }
}