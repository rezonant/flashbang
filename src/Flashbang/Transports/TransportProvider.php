<?php

/**
 * Provides a transport mechanism for moving the files defined
 * in a FileManifest object onto a (usually) remote server.
 * 
 * @author liam
 */
abstract class TransportProvider {
	/**
	 * Construct a Destination object for the given $params.
	 * 
	 * @param object $params The parameters provided by the user
	 * @return \Flashbang\Transports\Destination The realized destination object
	 * @throws BadParameterException Thrown if parameters are incorrect or missing
	 */
	public abstract function getDestination($params);
	
	/**
	 * Send the files defined by the given file $manifest to the given $destination.
	 * @throws ConnectionException Thrown if an error occurs while trying to connect 
	 *								or transfer the files.
	 */
	public abstract function send(FileManifest $manifest, Destination $destination);
}
