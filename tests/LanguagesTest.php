<?php declare(strict_types=1);

namespace BabDev\Transifex\Tests;

use BabDev\Transifex\Languages;

/**
 * Test class for \BabDev\Transifex\Languages.
 */
class LanguagesTest extends TransifexTestCase
{
    /**
     * @testdox createLanguage() returns a Response object indicating a successful API connection
     *
     * @covers  \BabDev\Transifex\Languages::createLanguage
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testCreateLanguage()
    {
        $this->prepareSuccessTest(201);

        // Additional options
        $options = [
            'translators' => ['mbabker'],
            'reviewers'   => ['mbabker'],
            'list'        => 'test@example.com',
        ];

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->createLanguage(
            'babdev-transifex',
            'en_US',
            ['mbabker'],
            $options,
            true
        );

        $this->validateSuccessTest('/api/2/project/babdev-transifex/languages/', 'POST', 201);

        $this->assertSame(
            'skip_invalid_username',
            $this->client->getRequest()->getUri()->getQuery(),
            'The API request did not include the expected query string.'
        );
    }

    /**
     * @testdox createLanguage() returns a Response object indicating a failed API connection
     *
     * @covers  \BabDev\Transifex\Languages::createLanguage
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testCreateLanguageFailure()
    {
        $this->prepareFailureTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->createLanguage('babdev-transifex', 'en_US', ['mbabker']);

        $this->validateFailureTest('/api/2/project/babdev-transifex/languages/', 'POST');
    }

    /**
     * @testdox createLanguage() throws an InvalidArgumentException when no contributors are given
     *
     * @covers  \BabDev\Transifex\Languages::createLanguage
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     *
     * @expectedException \InvalidArgumentException
     */
    public function testCreateLanguageNoUsers()
    {
        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->createLanguage('babdev-transifex', 'en_US', []);
    }

    /**
     * @testdox deleteLanguage() returns a Response object indicating a successful API connection
     *
     * @covers  \BabDev\Transifex\Languages::deleteLanguage
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testDeleteLanguage()
    {
        $this->prepareSuccessTest(204);

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->deleteLanguage('babdev-transifex', 'en_US');

        $this->validateSuccessTest('/api/2/project/babdev-transifex/language/en_US/', 'DELETE', 204);
    }

    /**
     * @testdox deleteLanguage() returns a Response object indicating a failed API connection
     *
     * @covers  \BabDev\Transifex\Languages::deleteLanguage
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testDeleteLanguageFailure()
    {
        $this->prepareFailureTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->deleteLanguage('babdev-transifex', 'en_US');

        $this->validateFailureTest('/api/2/project/babdev-transifex/language/en_US/', 'DELETE');
    }

    /**
     * @testdox getCoordinators() returns a Response object indicating a successful API connection
     *
     * @covers  \BabDev\Transifex\Languages::getCoordinators
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testGetCoordinators()
    {
        $this->prepareSuccessTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->getCoordinators('babdev-transifex', 'en_US');

        $this->validateSuccessTest('/api/2/project/babdev-transifex/language/en_US/coordinators/');
    }

    /**
     * @testdox getCoordinators() returns a Response object indicating a failed API connection
     *
     * @covers  \BabDev\Transifex\Languages::getCoordinators
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testGetCoordinatorsFailure()
    {
        $this->prepareFailureTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->getCoordinators('babdev-transifex', 'en_US');

        $this->validateFailureTest('/api/2/project/babdev-transifex/language/en_US/coordinators/');
    }

    /**
     * @testdox getLanguage() returns a Response object indicating a successful API connection
     *
     * @covers  \BabDev\Transifex\Languages::getLanguage
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testGetLanguage()
    {
        $this->prepareSuccessTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->getLanguage('babdev-transifex', 'en_US');

        $this->validateSuccessTest('/api/2/project/babdev-transifex/language/en_US/');
    }

    /**
     * @testdox getLanguage() returns a Response object indicating a successful API connection
     *
     * @covers  \BabDev\Transifex\Languages::getLanguage
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testGetLanguageWithDetails()
    {
        $this->prepareSuccessTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->getLanguage('babdev-transifex', 'en_US', true);

        $this->validateSuccessTest('/api/2/project/babdev-transifex/language/en_US/');

        $this->assertSame(
            'details',
            $this->client->getRequest()->getUri()->getQuery(),
            'The API request did not include the expected query string.'
        );
    }

    /**
     * @testdox getLanguage() returns a Response object indicating a failed API connection
     *
     * @covers  \BabDev\Transifex\Languages::getLanguage
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testGetLanguageFailure()
    {
        $this->prepareFailureTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->getLanguage('babdev-transifex', 'en_US');

        $this->validateFailureTest('/api/2/project/babdev-transifex/language/en_US/');
    }

    /**
     * @testdox getLanguages() returns a Response object indicating a successful API connection
     *
     * @covers  \BabDev\Transifex\Languages::getLanguages
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testGetLanguages()
    {
        $this->prepareSuccessTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->getLanguages('babdev-transifex');

        $this->validateSuccessTest('/api/2/project/babdev-transifex/languages/');
    }

    /**
     * @testdox getLanguages() returns a Response object indicating a failed API connection
     *
     * @covers  \BabDev\Transifex\Languages::getLanguages
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testGetLanguagesFailure()
    {
        $this->prepareFailureTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->getLanguages('babdev-transifex');

        $this->validateFailureTest('/api/2/project/babdev-transifex/languages/');
    }

    /**
     * @testdox getReviewers() returns a Response object indicating a successful API connection
     *
     * @covers  \BabDev\Transifex\Languages::getReviewers
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testGetReviewers()
    {
        $this->prepareSuccessTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->getReviewers('babdev-transifex', 'en_US');

        $this->validateSuccessTest('/api/2/project/babdev-transifex/language/en_US/reviewers/');
    }

    /**
     * @testdox getReviewers() returns a Response object indicating a failed API connection
     *
     * @covers  \BabDev\Transifex\Languages::getReviewers
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testGetReviewersFailure()
    {
        $this->prepareFailureTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->getReviewers('babdev-transifex', 'en_US');

        $this->validateFailureTest('/api/2/project/babdev-transifex/language/en_US/reviewers/');
    }

    /**
     * @testdox getTranslators() returns a Response object indicating a successful API connection
     *
     * @covers  \BabDev\Transifex\Languages::getTranslators
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testGetTranslators()
    {
        $this->prepareSuccessTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->getTranslators('babdev-transifex', 'en_US');

        $this->validateSuccessTest('/api/2/project/babdev-transifex/language/en_US/translators/');
    }

    /**
     * @testdox getTranslators() returns a Response object indicating a failed API connection
     *
     * @covers  \BabDev\Transifex\Languages::getTranslators
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testGetTranslatorsFailure()
    {
        $this->prepareFailureTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->getTranslators('babdev-transifex', 'en_US');

        $this->validateFailureTest('/api/2/project/babdev-transifex/language/en_US/translators/');
    }

    /**
     * @testdox updateCoordinators() returns a Response object indicating a successful API connection
     *
     * @covers  \BabDev\Transifex\Languages::updateCoordinators
     * @covers  \BabDev\Transifex\Languages::updateTeam
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testUpdateCoordinators()
    {
        $this->prepareSuccessTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->updateCoordinators('babdev-transifex', 'en_US', ['mbabker'], true);

        $this->validateSuccessTest('/api/2/project/babdev-transifex/language/en_US/coordinators/', 'PUT');

        $this->assertSame(
            'skip_invalid_username',
            $this->client->getRequest()->getUri()->getQuery(),
            'The API request did not include the expected query string.'
        );
    }

    /**
     * @testdox updateCoordinators() returns a Response object indicating a failed API connection
     *
     * @covers  \BabDev\Transifex\Languages::updateCoordinators
     * @covers  \BabDev\Transifex\Languages::updateTeam
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testUpdateCoordinatorsFailure()
    {
        $this->prepareFailureTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->updateCoordinators('babdev-transifex', 'en_US', ['mbabker']);

        $this->validateFailureTest('/api/2/project/babdev-transifex/language/en_US/coordinators/', 'PUT');
    }

    /**
     * @testdox updateCoordinators() throws an InvalidArgumentException when no contributors are given
     *
     * @covers  \BabDev\Transifex\Languages::updateCoordinators
     * @covers  \BabDev\Transifex\Languages::updateTeam
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     *
     * @expectedException \InvalidArgumentException
     */
    public function testUpdateCoordinatorsNoUsers()
    {
        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->updateCoordinators('babdev-transifex', 'en_US', []);
    }

    /**
     * @testdox updateLanguage() returns a Response object indicating a successful API connection
     *
     * @covers  \BabDev\Transifex\Languages::updateLanguage
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testUpdateLanguage()
    {
        $this->prepareSuccessTest();

        // Additional options
        $options = [
            'translators' => ['mbabker'],
            'reviewers'   => ['mbabker'],
            'list'        => 'test@example.com',
        ];

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->updateLanguage('babdev-transifex', 'en_US', ['mbabker'], $options);

        $this->validateSuccessTest('/api/2/project/babdev-transifex/language/en_US/', 'PUT');
    }

    /**
     * @testdox updateLanguage() returns a Response object indicating a failed API connection
     *
     * @covers  \BabDev\Transifex\Languages::updateLanguage
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testUpdateLanguageFailure()
    {
        $this->prepareFailureTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->updateLanguage('babdev-transifex', 'en_US', ['mbabker']);

        $this->validateFailureTest('/api/2/project/babdev-transifex/language/en_US/', 'PUT');
    }

    /**
     * @testdox updateLanguage() throws an InvalidArgumentException when no contributors are given
     *
     * @covers  \BabDev\Transifex\Languages::updateLanguage
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     *
     * @expectedException \InvalidArgumentException
     */
    public function testUpdateLanguageNoUsers()
    {
        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->updateLanguage('babdev-transifex', 'en_US', []);
    }

    /**
     * @testdox updateReviewers() returns a Response object indicating a successful API connection
     *
     * @covers  \BabDev\Transifex\Languages::updateReviewers
     * @covers  \BabDev\Transifex\Languages::updateTeam
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testUpdateReviewers()
    {
        $this->prepareSuccessTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->updateReviewers('babdev-transifex', 'en_US', ['mbabker'], true);

        $this->validateSuccessTest('/api/2/project/babdev-transifex/language/en_US/reviewers/', 'PUT');

        $this->assertSame(
            'skip_invalid_username',
            $this->client->getRequest()->getUri()->getQuery(),
            'The API request did not include the expected query string.'
        );
    }

    /**
     * @testdox updateReviewers() returns a Response object indicating a failed API connection
     *
     * @covers  \BabDev\Transifex\Languages::updateReviewers
     * @covers  \BabDev\Transifex\Languages::updateTeam
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testUpdateReviewersFailure()
    {
        $this->prepareFailureTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->updateReviewers('babdev-transifex', 'en_US', ['mbabker']);

        $this->validateFailureTest('/api/2/project/babdev-transifex/language/en_US/reviewers/', 'PUT');
    }

    /**
     * @testdox updateReviewers() throws an InvalidArgumentException when no contributors are given
     *
     * @covers  \BabDev\Transifex\Languages::updateReviewers
     * @covers  \BabDev\Transifex\Languages::updateTeam
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     *
     * @expectedException \InvalidArgumentException
     */
    public function testUpdateReviewersNoUsers()
    {
        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->updateReviewers('babdev-transifex', 'en_US', []);
    }

    /**
     * @testdox updateTranslators() returns a Response object indicating a successful API connection
     *
     * @covers  \BabDev\Transifex\Languages::updateTranslators
     * @covers  \BabDev\Transifex\Languages::updateTeam
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testUpdateTranslators()
    {
        $this->prepareSuccessTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->updateTranslators('babdev-transifex', 'en_US', ['mbabker'], true);

        $this->validateSuccessTest('/api/2/project/babdev-transifex/language/en_US/translators/', 'PUT');

        $this->assertSame(
            'skip_invalid_username',
            $this->client->getRequest()->getUri()->getQuery(),
            'The API request did not include the expected query string.'
        );
    }

    /**
     * @testdox updateTranslators() returns a Response object indicating a failed API connection
     *
     * @covers  \BabDev\Transifex\Languages::updateTranslators
     * @covers  \BabDev\Transifex\Languages::updateTeam
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     */
    public function testUpdateTranslatorsFailure()
    {
        $this->prepareFailureTest();

        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->updateTranslators('babdev-transifex', 'en_US', ['mbabker']);

        $this->validateFailureTest('/api/2/project/babdev-transifex/language/en_US/translators/', 'PUT');
    }

    /**
     * @testdox updateTranslators() throws an InvalidArgumentException when no contributors are given
     *
     * @covers  \BabDev\Transifex\Languages::updateTranslators
     * @covers  \BabDev\Transifex\Languages::updateTeam
     * @covers  \BabDev\Transifex\TransifexObject
     *
     * @uses    \BabDev\Transifex\TransifexObject
     *
     * @expectedException \InvalidArgumentException
     */
    public function testUpdateTranslatorsNoUsers()
    {
        (new Languages($this->client, $this->requestFactory, $this->streamFactory, $this->uriFactory, $this->options))->updateTranslators('babdev-transifex', 'en_US', []);
    }
}
