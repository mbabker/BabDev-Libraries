<?php
/**
 * BabDev Transifex Package

 * @package     BabDev.Library
 * @subpackage  Transifex
 *
 * @copyright   Copyright (C) 2012-2013 Michael Babker. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Transifex API Projects class.
 *
 * @package     BabDev.Library
 * @subpackage  Transifex
 * @since       1.0
 */
class BDTransifexProjects extends BDTransifexObject
{
	/**
	 * Method to create a project.
	 *
	 * @param   string  $name            The name of the project
	 * @param   string  $slug            The slug for the project
	 * @param   string  $description     A description of the project
	 * @param   string  $sourceLanguage  The source language code for the project
	 *
	 * @return  void
	 *
	 * @since   1.0
	 * @throws  DomainException
	 */
	public function createProject($name, $slug, $description, $sourceLanguage)
	{
		// Build the request path.
		$path = '/projects/';

		// Build the request data.
		$data = json_encode(
			array(
				'name' => $name,
				'slug' => $slug,
				'description' => $description,
				'source_language_code' => $sourceLanguage
			)
		);

		// Send the request.
		return $this->processResponse($this->client->post($this->fetchUrl($path), $data, array('Content-Type' => 'application/json')), 201);
	}

	/**
	 * Method to delete a project.
	 *
	 * @param   string  $slug  The slug for the resource.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 * @throws  DomainException
	 */
	public function deleteProject($slug)
	{
		// Build the request path.
		$path = '/project/' . $slug;

		// Send the request.
		return $this->processResponse($this->client->delete($this->fetchUrl($path)), 204);
	}

	/**
	 * Method to get information about a project.
	 *
	 * @param   string   $project  The project to retrieve details for
	 * @param   boolean  $details  True to retrieve additional project details
	 *
	 * @return  array  The project details from the API.
	 *
	 * @since   1.0
	 * @throws  DomainException
	 */
	public function getProject($project, $details = false)
	{
		// Build the request path.
		$path = '/project/' . $project . '/';

		if ($details)
		{
			$path .= '?details';
		}

		// Send the request.
		return $this->processResponse($this->client->get($this->fetchUrl($path)));
	}

	/**
	 * Method to get a list of projects the user is part of.
	 *
	 * @return  array  The list of projects from the API.
	 *
	 * @since   1.0
	 * @throws  DomainException
	 */
	public function getProjects()
	{
		// Build the request path.
		$path = '/projects/';

		// Send the request.
		return $this->processResponse($this->client->get($this->fetchUrl($path)));
	}
}
