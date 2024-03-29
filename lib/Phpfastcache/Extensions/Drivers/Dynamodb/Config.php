<?php

/**
 *
 * This file is part of Phpfastcache.
 *
 * @license MIT License (MIT)
 *
 * For full copyright and license information, please see the docs/CREDITS.txt and LICENCE files.
 *
 * @author Georges.L (Geolim4)  <contact@geolim4.com>
 * @author Contributors  https://github.com/PHPSocialNetwork/phpfastcache/graphs/contributors
 */

declare(strict_types=1);

namespace Phpfastcache\Extensions\Drivers\Dynamodb;

use Phpfastcache\Config\ConfigurationOption;
use Phpfastcache\Core\Pool\ExtendedCacheItemPoolInterface;
use Phpfastcache\Exceptions\PhpfastcacheLogicException;

/**
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class Config extends ConfigurationOption
{
    protected ?string $awsAccessKeyId = null;
    protected ?string $awsSecretAccessKey = null;
    protected bool $allowEnvCredentialOverride = false;
    protected ?string $endpoint = null;
// List of endpoints here: https://docs.aws.amazon.com/general/latest/gr/ddb.html

    protected string $region;
    protected string $table;
    protected bool $debugEnabled = false;
    protected string $version = 'latest';
    protected string $partitionKey = ExtendedCacheItemPoolInterface::DRIVER_KEY_WRAPPER_INDEX;
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);
        $this->awsAccessKeyId = $this->getSuperGlobalAccessor()('SERVER', 'AWS_ACCESS_KEY_ID');
        $this->awsSecretAccessKey = $this->getSuperGlobalAccessor()('SERVER', 'AWS_SECRET_ACCESS_KEY');
    }

    /**
     * @return string|null
     */
    public function getAwsAccessKeyId(): ?string
    {
        return $this->awsAccessKeyId;
    }

    /**
     * @param string|null $awsAccessKeyId
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setAwsAccessKeyId(?string $awsAccessKeyId): Config
    {
        if ($awsAccessKeyId !== null) {
            if (!getenv('AWS_ACCESS_KEY_ID')) {
                if (!$this->isAllowEnvCredentialOverride()) {
                    throw new PhpfastcacheLogicException('You are not allowed to override AWS environment variables.');
                }
                \putenv("AWS_ACCESS_KEY_ID=$awsAccessKeyId");
            }

            return $this->setProperty('awsAccessKeyId', getenv('AWS_ACCESS_KEY_ID'));
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAwsSecretAccessKey(): ?string
    {
        return $this->awsSecretAccessKey;
    }

    /**
     * @param string|null $awsSecretAccessKey
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setAwsSecretAccessKey(?string $awsSecretAccessKey): Config
    {
        if ($awsSecretAccessKey !== null) {
            if (!getenv('AWS_SECRET_ACCESS_KEY')) {
                if (!$this->isAllowEnvCredentialOverride()) {
                    throw new PhpfastcacheLogicException('You are not allowed to override AWS environment variables.');
                }
                \putenv("AWS_SECRET_ACCESS_KEY=$awsSecretAccessKey");
            }

            return $this->setProperty('awsSecretAccessKey', getenv('AWS_SECRET_ACCESS_KEY'));
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function isAllowEnvCredentialOverride(): bool
    {
        return $this->allowEnvCredentialOverride;
    }

    /**
     * @param bool $allowEnvCredentialOverride
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setAllowEnvCredentialOverride(bool $allowEnvCredentialOverride): Config
    {
        return $this->setProperty('allowEnvCredentialOverride', $allowEnvCredentialOverride);
    }

    /**
     * @return ?string
     */
    public function getEndpoint(): ?string
    {
        return $this->endpoint;
    }

    /**
     * @param ?string $endpoint
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setEndpoint(?string $endpoint): Config
    {
        if (!\str_starts_with($endpoint, 'https://') && \str_ends_with($endpoint, 'amazonaws.com')) {
            $endpoint = 'https://' . $endpoint;
        }
        return $this->setProperty('endpoint', $endpoint);
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setRegion(string $region): Config
    {
        return $this->setProperty('region', $region);
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @param string $table
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setTable(string $table): Config
    {
        return $this->setProperty('table', $table);
    }

    /**
     * @return bool
     */
    public function isDebugEnabled(): bool
    {
        return $this->debugEnabled;
    }

    /**
     * @param bool $debugEnabled
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setDebugEnabled(bool $debugEnabled): Config
    {
        return $this->setProperty('debugEnabled', $debugEnabled);
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setVersion(string $version): Config
    {
        return $this->setProperty('version', $version);
    }

    /**
     * @return string
     */
    public function getPartitionKey(): string
    {
        return $this->partitionKey;
    }

    /**
     * @param string $partitionKey
     * @return Config
     * @throws PhpfastcacheLogicException
     */
    public function setPartitionKey(string $partitionKey): Config
    {
        return $this->setProperty('partitionKey', $partitionKey);
    }
}
